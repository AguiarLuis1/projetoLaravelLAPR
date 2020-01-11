<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Mail;

class ContactFormController extends Controller
{
    public function create()
    {
        return view('contact.create');
    }

    public function store()
    {
        $data = request()->validate([
            'name' => 'required',
            'email' => 'required',
            'message' => 'required',
        ]);

        Mail::to('test@test.com')->send(new ContactFormMail($data));
        session()->flash('notif', 'Suporte enviado com sucesso, em breve receberá uma resposta!');
        return redirect('/');
    }
}
