<?php

namespace App\Http\Controllers;

use App\Books;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $book = new Books();
        $book->title = $request->title;
        $book->authorOfBook = $request->authorOfBook;
        $book->price = $request->price;
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
            ->update(['title' => $request->title, 'authorOfBook' => $request->authorOfBook, 'price' => $request->price, 'language' => $request->language, 'isbn' => $request->isbn]);
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
            'language' => 'required',
            'isbn' => 'required',
            'image' => 'file|image|max:5000', //5 mb tamanho max
        ]);

    }
}
