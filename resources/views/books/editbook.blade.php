@extends('layouts.app')

@section('title','Editar Livro')

@section('content')
</br>
<h1><span class="badge badge-dark">Editar Livro</span></h1></br>
@include('errors')
<form action="{{route('books.update',$book->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="title">Titulo:</label>
        <input type="text" name="title" class="form-control" value="{{$book->title}}">
    </div>
    <div class="form-group">
        <label for="authorOfBook">Autor(es):</label>
        <input type="text" name="authorOfBook" class="form-control" value='{{$book->authorOfBook}}'>
    </div>
    <div class="form-group">
        <label for="price">Preço:</label>
        <input type="float" name="price" class="form-control" value='{{$book->price}}'>
    </div>
    <div class="form-group">
        <label for="contact">Contacto telefónico:</label>
        <input type="number" name="contact" class="form-control" value='{{$book->contact}}'>
    </div>
    <div class="form-group">
        <label for="language">Linguagem:</label>
        <input type="text" name="language" class="form-control" value='{{$book->language}}'>
    </div>
    <div class="form-group">
        <label for="ISBN">ISBN:</label>
        <input type="number" name="isbn" class="form-control" value='{{$book->isbn}}'>
    </div>
    </br><button type="submit" class="btn btn-primary">Update</button>
</form>


@endsection