<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Peludos | Todo para tu mascota</title>
    <link rel="shortcut icon" href="{{ Vite::asset('resources/img/perro.svg') }}" type="image/x-icon">

    {{-- Import Bulma --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    {{-- Import FontAwesome --}}
    <script src="https://kit.fontawesome.com/c04f1e2916.js" crossorigin="anonymous"></script>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="">
        <nav class="navbar" role="navigation" aria-label="main navigation">
            {{-- Logo --}}
            <div class="navbar-brand">
                <a class="navbar-item" href="{{ route('home') }}">
                    <img src="{{ Vite::asset('resources/img/logo-blanco.png') }}" class="logo-brand" alt="Logo Peludos">
                </a>
                {{-- Mobile menu --}}
                {{-- <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbar">
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                </a> --}}
            </div>

            <div id="navbar" class="navbar-menu">
                {{-- Right navbar --}}
                <div class="navbar-end">
                    <div class="navbar-item mr-5">
                        <div class="buttons">
                            <span>escríbenos</span>
                            <i class="fa-brands fa-whatsapp fa-large ml-2"></i>
                        </div>
                    </div>
                    <div class="navbar-item mr-5">
                        <div class="buttons">
                            <i class="fa-solid fa-cart-shopping fa-large"></i>
                        </div>
                    </div>
                    @guest
                    <div class="navbar-item">
                        <div class="buttons">
                            <a href="{{ route('register') }}" class="mr-4">
                                <strong>Regístrate</strong>
                            </a>
                            <a href="{{ route('login') }}">
                                Inicia sesión
                            </a>
                        </div>
                    </div>
                    @endguest
                    @auth
                    <div class="navbar-item">
                        <div class="buttons">
                            <a href="{{ route('logout') }}">
                                Cerrar sesión
                            </a>
                        </div>
                    </div>                        
                    @endauth
                </div>
            </div>
        </nav>
        <nav class="navbar navbar-search">
            <div class="navbar-start">
                <a href="{{ route('animals', 1) }}" class="navbar-item btn-animal">
                    <img src="{{ Vite::asset('resources/img/perro.svg') }}" alt="logo perro">
                    perros
                </a>    
                <a href="{{ route('animals', 2) }}" class="navbar-item btn-animal">
                    <img src="{{ Vite::asset('resources/img/gato.svg') }}" alt="logo gato">
                    gatos        
                </a>
            </div>
            <div class="navbar-end">
                <div class="control has-icons-left has-icons-right">
                    <input class="input is-small search-input" type="email" placeholder="Buscar">
                    <span class="icon is-small is-left">
                        <i class="fas fa-search fa-small"></i>
                    </span>
                </div>
            </div>
        </nav>
        <main>
            @yield('content')
        </main>
    </div>
</body>
</html>