<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>@yield('title','Re-Lidos')</title>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-dark shadow-sm">
            <div class="container">
                <a class="navbar-brand text-white" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item ">
                                    <a class="nav-link text-primary" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                        <li class="nav-item right px-1">
                            <a class="btn btn-outline-light" href="{{route('books.create')}}">Criar anúncio</a>
                        </li>

                        <li class="nav-item right px-1">
                            <a class="btn btn-outline-light" href="{{route('books.mybooks')}}">Meus anúncios</a>
                        </li>

                        <li class="nav-item right px-1">
                            <a class="btn btn-outline-light" href="{{route('contact.create')}}">Contacte-nos</a>
                        </li>
                        <li class="nav-item right px-1">
                            <a class="btn btn-outline-light" href="{{route('user.edit')}}">Editar perfil</a>
                        </li>
                        <li class="nav-item right px-1">
                                    <a class="btn btn-outline-danger" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>

                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        @if (Request:: is('/'))
      <div class="view">
        <img class="h-50 d-incline-block w-100 " src="{{asset('/images/booook.jpg')}}" alt="First slide">
      </div>
      <div class="carousel-caption">
        <h1 class="h1-responsive text-light"><strong>Bem-vindos ao RelidosUFP</strong></h1>
        <h2 class="h2-responsive text-light">compre ou venda o seu livro aqui </h2>
      </div>

        @endif

        <main class="container mt-4">
            @if(session()->has('notif'))

                    <div class="alert alert-success" align="center">
                        <strong>Notificação: </strong>{{session()->get('notif')}}
                    </div>

            @endif
            @if(session()->has('err'))

                    <div class="alert alert-danger" align="center">
                        <strong>Aviso: </strong>{{session()->get('err')}}
                    </div>

            @endif
            @yield('content')

        </main>
    </div>
</body>
</html>
