<?php

namespace App\Http\Controllers;

use App\Books;
use App\Cart;
use App\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Omnipay\Omnipay;
use Session;

class BooksController extends Controller
{

    public function showAll()
    {
        $books = Books::orderBy('created_at', 'desc')->paginate(3); //retorna todos os livros ordenados por publicação, 10 por página
        return view('books.showselected', ['books' => $books]);
    }

    //retorna o form para inserir
    public function create()
    {
        return view('books.insert');
    }

    //inserir o novo livro na bd
    public function store(Request $request) //melhor que usar o $_POST

    {
        $this->validateData();
        request()->validate([
            'image' => 'required|file|image|max:5000', //5 mb tamanho max
        ], [
            'image.required' => 'É necessário inserir uma imagem',
            'image.max' => 'Insira uma imagem até 5kb',
            'image.file' => 'O ficheiro tem de ser uma imagem',
            'image.image' => 'O ficheiro tem de ser uma imagem',
        ]);

        $book = new Books();
        $book->title = $request->title;
        $book->authorOfBook = $request->authorOfBook;
        $book->price = $request->price;
        $book->contact = $request->contact;
        $book->contactMail = Auth::user()->email;
        $book->creator = Auth::user()->name;
        $book->idCreator = Auth::id();
        $book->language = $request->language;
        $book->isbn = $request->isbn;
        $book->created_at = now();
        $book->save();
        $book->update([
            'image' => $request->image->store('uploads', 'public'), //guarda a imagem internamente na pasta definida
        ]);
        session()->flash('notif', 'O anúncio foi criado com sucesso!');
        return redirect('/');
    }
    public function view($id)
    {
        $book = Books::findOrFail($id);
        if ($book->idCreator == Auth::id()) {
            return view('books.viewmybook', ['book' => $book]); //view com delete e update
        } else {
            return view('books.viewbook', ['book' => $book]);
        }

    }
    public function delete($id)
    {
        Books::findOrFail($id)->delete();
        session()->flash('notif', 'O anúncio foi apagado com sucesso!');
        return redirect('/');
    }

    public function edit($id)
    {
        $book = Books::findOrFail($id);
        if ($book->idCreator == Auth::id()) { //se o livro que pretende editar fôr dele
            return view('books.editbook', ['book' => $book]);
        } else {
            session()->flash('err', 'Este anúncio não lhe pertence!');
            return redirect('/');
        }
    }

    //submeter a edição da tabela e retorna a homepage
    public function editSubmit($id, Request $request)
    {
        $this->validateData();
        Books::where('id', $id)
            ->update(['title' => $request->title, 'authorOfBook' => $request->authorOfBook, 'price' => $request->price, 'contact' => $request->contact, 'language' => $request->language, 'isbn' => $request->isbn]);
        session()->flash('notif', 'O anúncio foi atualizada com sucesso!');
        return redirect('/');
    }
    //mostrar os livros do user com login
    public function showMyBooks()
    {
        $books = Books::where('idCreator', Auth::id())->paginate(10);
        return view('books.showselected', ['books' => $books]);
    }

    public function validateData() //valida os inputs do user

    {
        request()->validate([
            'title' => 'required',
            'authorOfBook' => 'required',
            'price' => 'required',
            'contact' => 'required',
            'language' => 'required',
            'isbn' => 'required',

        ], [
            'title.required' => 'É necessário inserir um título',
            'authorOfBook.required' => 'É necessário inserir os autores do livro',
            'price.required' => 'É necessário inserir um preço',
            'contact.required' => 'É necessário inserir um contacto telefónico',
            'language.required' => 'É necessário inserir a linguagem do livro',
            'isbn.required' => 'É necessário inserir o ISBN do livro',
        ]);
    }
    /*
    Adiciona o livro a um carrinho armazenado na session
     */
    public function addToCart($id, Request $request)
    {
        $book = Books::findOrFail($id);
        $cart = Session::has('cart') ? Session::get('cart') : new Cart(); //se a session já tiver um cart vai busca-lo

        $cart->add($book, $book->id);

        $request->session()->put('cart', $cart); //adiciona o novo cart á session

        session()->flash('notif', 'Livro adicionado ao carrinho!');

        return redirect('/');
    }
    public function showCart()
    {
        if (!Session::has('cart')) { //se a sessão não tiver um cart
            return view('shop.showCart');

        }
        $cart = Session::get('cart');
        return view('shop.showcart', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice]); //retorna a vista enviando como argumentos os produtos e o custo total
    }

    public function checkout()
    {
        if (!Session::has('cart')) { //se a sessão não tiver um cart
            return view('shop.showCart');
        }
        $cart = Session::get('cart');
        $total = $cart->totalPrice;
        return view('shop.checkout', ['total' => $total]); //retorna a vista de checkout e envia como args o preço total a pagar

    }

    public function postCheckout(Request $request)
    {
        if ($request->input('stripeToken')) {

            $gateway = Omnipay::create('Stripe');
            $gateway->setApiKey(env('STRIPE_SECRET_KEY'));

            $token = $request->input('stripeToken');

            $response = $gateway->purchase([
                'amount' => $request->input('amount'),
                'currency' => env('STRIPE_CURRENCY'),
                'token' => $token,
            ])->send();

            if ($response->isSuccessful()) {
                // se o pagamendo fôr bem sucedido
                $arr_payment_data = $response->getData();

                $isPaymentExist = Payment::where('payment_id', $arr_payment_data['id'])->first();

                if (!$isPaymentExist) {
                    $payment = new Payment;
                    $payment->payment_id = $arr_payment_data['id'];
                    $payment->payer_email = $request->input('email');
                    $payment->amount = $arr_payment_data['amount'] / 100;
                    $payment->currency = env('STRIPE_CURRENCY');
                    $payment->payment_status = $arr_payment_data['status'];
                    $payment->save();
                }

                session()->flash('notif', 'Pagamento bem sucedido');
                return redirect('/');
            } else {
                // mensagem de erro
                return $response->getMessage();
            }
        }
    }
}
