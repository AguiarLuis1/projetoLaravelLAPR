@extends('layouts.app')

@section('title','Ver livro')

@section('content')

@include('books.bookinfo')

<a href="{{route('book.addToCart',$book->id)}}" class="btn btn-secondary float-right">Adicionar ao Carrinho!</a>

@endsection
