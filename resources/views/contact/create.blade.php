@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')
    <h1>Entre em contacto</h1>


        <form action="{{ route('contact.store') }}" method="POST">
            <div class="form-group">
                <label for="name">Nome:</label>
                <input type="text" name="name" value="{{ old('name') }}" class="form-control">
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" name="email" value="{{ old('email') }}" class="form-control">
            </div>

            <div class="form-group">
                <label for="message">Mensagem:</label>
                <textarea name="message" id="message" cols="30" rows="10"
                          class="form-control">{{ old('message') }}</textarea>
            </div>

            @csrf

            <button type="submit" class="btn btn-primary">Enviar mensagem</button>
        </form>

@endsection
