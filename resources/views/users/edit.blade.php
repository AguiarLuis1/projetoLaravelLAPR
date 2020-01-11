@extends('layouts.app')

@section('title','Editar Utilizador')

@section('content')
<h3 class="text-center">Editar utilizador</h3>
@include('errors')
<form method="post" action="{{route('user.update')}}">
    @csrf
    @method('PUT')
    <div class="form-group">
            <label for="name">Nome:</label>
            <input type="text" name="name" class="form-control" value="{{ $user->name }}">
    </div>
    <div class="form-group">
        <label for="email">Nome:</label>
        <input type="email" name="email" class="form-control" value="{{ $user->email }}">
    </div>
    <div class="form-group">
        <label for="password">Password nova:</label>
        <input type="password" name="password" class="form-control" >
    </div>
    <div class="form-group">
        <label for="password_confirmation">Confirmação password nova:</label>
        <input type="password" name="password_confirmation" class="form-control" >
    </div>
    <div class="form-group">
        <label for="passwordCheck"><strong>Password atual:</strong></label>
        <input type="password" name="passwordCheck" class="form-control" >
    </div>

    <button type="submit" class="btn btn-primary">Editar</button>
</form>

@endsection
