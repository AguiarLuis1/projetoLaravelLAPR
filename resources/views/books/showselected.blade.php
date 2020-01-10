@extends('layouts.app')

@section('title','Relidos UFP')

@section('content')

    <h2 class="text-center">Livros para venda</h2>
    <table border=1 class="table">
    <thead class="thead-light">
        <tr><th>Título</th><th>Autor(es)</th><th>Preço</th><th>Linguagem</th><th>Publicado</th></tr>
    </thead>
        @forelse($books as $book)
        <tr>
        <td>{{$book->title}}</td>
        <td>{{$book->authorOfBook}}</td>
        <td>{{$book->price}}&euro;</td>
        <td>{{$book->language}}</td>
        <td>{{$book->created_at->diffForHumans()}}</td>
        <td><a href="book/{{$book->id}}">Ver mais!</a>
        </tr>

        @empty
        <div class="alert alert-danger" role="alert">
            <h5><center>Sem Livros para mostrar!</center></h5>
        </div>
        @endforelse

    </table>

    {{$books->links()}} <!--Cria navbar de acordo com o resultado da query -->
@endsection
