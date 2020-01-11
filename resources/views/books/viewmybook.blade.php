@extends('layouts.app')

@section('title','Ver livro')

@section('content')


<a href="{{route('books.edit',$book->id)}}" class="btn btn-primary float-left">Editar</a>

<form method="POST" id="delete-form" action="{{route('books.delete',$book->id)}}">
    @csrf
    @method('DELETE')
    <div class="text-right">
        <button type="submit" class="btn btn-danger">Apagar</button>
    </div>
</form>

@include('books.bookinfo')

@endsection
