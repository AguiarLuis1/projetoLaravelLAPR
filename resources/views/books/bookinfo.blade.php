<strong>Título:</strong> {{$book->title}}</br>
<strong>Autor(es):</strong>  {{$book->authorOfBook}}</br>
<strong>Preço:</strong>  {{$book->price}}&euro;</br>
<strong>Contacto telefónico:</strong> {{$book->contact}}</br>
<strong>Vendedor:</strong> {{$book->creator}}</br>
<strong>Linguagem:</strong> {{$book->language}}</br>
<strong>ISBN:</strong> {{$book->isbn}}</br></br>
@if($book->image)
    <div class="row">
        <div class="col-12">
            <img src="{{asset('storage/'.$book->image)}}" alt="" class="rounded mx-auto d-block">
        </div>
    </div>
@endif
