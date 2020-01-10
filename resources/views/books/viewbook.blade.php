@extends('layouts.app')

@section('title','Ver livro')

@section('content')

<strong>Título:</strong> {{$book->title}}</br>
<strong>Autor(es):</strong>  {{$book->authorOfBook}}</br>
<strong>Preço:</strong>  {{$book->price}}&euro;</br>
<strong>Vendedor:</strong> {{$book->creator}}</br>
<strong>Linguagem:</strong> {{$book->language}}</br>
<strong>ISBN:</strong> {{$book->isbn}}</br>
@endsection
