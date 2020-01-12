<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactFormController extends Controller
{
    public function create()
    {
        return view('contact.create');
    }

    public function store(Request $request)
    {
        
        $data = request()->validate([
            'name' => 'required',
            'email' => 'required',
            'message' => 'required',
        ], [
            'name.required' => 'É necessário inserir um nome no formulário',
            'email.required' => 'É necessário inserir um email no formulário',
            'message.required' => 'É necessário inserir uma mensagem no formulário',
        ]);

        Mail::to('test@test.com')->send(new ContactFormMail($data));
        session()->flash('notif', 'Suporte enviado com sucesso, em breve receberá uma resposta!');
        return redirect('/');
    }
}
