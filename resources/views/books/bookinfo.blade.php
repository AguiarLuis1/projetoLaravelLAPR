
</br></br>


<p align = left><font size= "5"><em><strong>&emsp;&emsp;&emsp;Imagem do Livro:</strong></em></font></p></br>
@if($book->image)
    <div class="row">
        <div class="col-12">
            <img src="{{asset('storage/'.$book->image)}}" alt=""  align = "left" class="rounded mx-auto d-block ">
        </div>
    </div>
@endif
</p>
<p align = right>
<font size="5"><em><b>Informação do anúncio:</b></em></font></br></br>
<strong><font size= "4">Título:</font></strong> {{$book->title}}</br>
<strong><font size= "4">Autor(es):</font></strong>  {{$book->authorOfBook}}</br>
<strong><font size= "4">Preço:</font></strong>  {{$book->price}}&euro;</br>
<strong><font size= "4">Contacto telefónico:</font></strong> {{$book->contact}}</br>
<strong><font size= "4">E-mail de contacto:</font></strong> {{$book->contactMail}}</br>
<strong><font size= "4">Vendedor:</font></strong> {{$book->creator}}</br>
<strong><font size= "4">Linguagem:</font></strong> {{$book->language}}</br>
<strong><font size= "4">ISBN:</font></strong> {{$book->isbn}}</p>
