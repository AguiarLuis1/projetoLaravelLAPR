@extends('layouts.app')

@section('title','Ver livro')

@section('content')

<strong>Título:</strong> {{$book->title}}</br>
<strong>Autor(es):</strong>  {{$book->authorOfBook}}</br>
<strong>Preço:</strong>  {{$book->price}}&euro;</br>
<strong>Vendedor:</strong> {{$book->creator}}</br>
<strong>Linguagem:</strong> {{$book->language}}</br>
<strong>ISBN:</strong> {{$book->isbn}}</br></br>
@if($book->image)
    <div class="row">
        <div class="col-12">
            <img src="{{asset('storage/'.$book->image)}}" alt="" class="img-thumbnail">
        </div>
    </div>
@endif
<a href="{{route('books.edit',$book->id)}}" class="btn btn-primary float-left">Editar</a>

<form method="POST" id="delete-form" action="{{route('books.delete',$book->id)}}">
    @csrf
    @method('DELETE')
    <div class="text-right">
        <button type="submit" class="btn btn-danger">Apagar</button>
    </div>
</form>
@endsection
