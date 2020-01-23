@extends('layouts.app')

@section('title','Relidos UFP')

@section('content')
<h1 class="text-left"><strong><em>Os mais recentes disponiveis</em></strong>

<div class="card-deck">
        @forelse($books as $book)


        <div class="card text-dark bg-light border-dark" style="max-width: 450px;">
            <div class="row no-gutters">
                <div class="col-md-4">
</br><img src="{{asset('storage/'.$book->image)}}" class="card-img" alt="...">
                </div>
                <div class="col-md-8">
                <div class="card-body">
                    <h4 class="card-title"><strong><ins>{{$book->title}}</ins></strong</h4>
                    <p class="card-text">{{$book->authorOfBook}}</p>
                    <p class="card-text"><strong>{{$book->price}}&euro;</strong></p>
                    <p class="card-text"><small class="text-muted">{{$book->created_at->diffForHumans()}}</small></p>
                    <a href="book/{{$book->id}}" class="btn btn-secondary">Ver Mais</a>
                </div>
                </div>
            </div>
        </div>


        @empty
        <div class="alert alert-danger" role="alert">
            <h5>Sem Livros para mostrar!</h5>
        </div>
        @endforelse
    </div>
    </br></br>
    {{$books->links()}} <!--Cria navbar de acordo com o resultado da query -->
</br></br>

@endsection
