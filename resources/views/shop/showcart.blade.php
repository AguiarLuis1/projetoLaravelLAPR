@extends('layouts.app')

@section('title','Carrinho de Compras')

@section('content')
    @if(Session::has('cart'))

    <h2>Preço Total: {{$totalPrice}}</h2>
    <table class="table">

    @foreach($products as $product)
    <tr>
        <td>
            <strong>{{$product['item']['title']}}</strong>
            </td>
            <td>
            <span class ="label label-success">{{$product['price']}}&euro;</span>
        </td>
    </tr>
    @endforeach
    </table>
    <a href="{{route('books.checkout')}}" class="btn btn-success float-right">Finalizar compra!</a>
    @else
    <div class="alert alert-danger" role="alert">
            <h5>O Seu carrinho está vazio!</h5>
        </div>

    @endif


@endsection
