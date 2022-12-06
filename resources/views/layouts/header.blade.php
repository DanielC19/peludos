<nav class="navbar" role="navigation" aria-label="main navigation">
    {{-- Logo --}}
    <div class="navbar-brand">
        @if (!isset($admin_view))
        <a class="navbar-item" href="{{ route('home') }}">
            <img src="{{ asset('storage/images/logo-blanco.png') }}" class="logo-brand" alt="Logo Peludos">
        </a>
        @else
        <a class="navbar-item" href="{{ route('orders') }}">
            <img src="{{ asset('storage/images/logo-blanco.png') }}" class="logo-brand" alt="Logo Peludos">
        </a>
        @endif
        {{-- Mobile menu --}}
        <a role="button" class="navbar-burger ml-5" aria-label="menu" aria-expanded="false" data-target="navbar">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a>
    </div>

    <div id="navbar" class="navbar-menu">
        {{-- Right navbar --}}
        <div class="navbar-end">
            @can('admin_view')
            <div class="navbar-item mr-5">
                <div class="buttons">
                    @if (isset($admin_view))
                    <a href="{{ route('home') }}">Vista Usuario</a>
                    @else
                    <a href="{{ route('products.index') }}">Vista Admin</a>
                    @endif
                </div>
            </div>                
            @else
            <div class="navbar-item mr-5">
                <div class="buttons">
                    <span>escríbenos</span>
                    <i class="fa-brands fa-whatsapp fa-large ml-2"></i>
                </div>
            </div>    
            @endcan
            <div class="navbar-item mr-5">
                <a href="{{ route('cart') }}" class="buttons">
                    <span id="navbar-cart-text">ver carrito</span>
                    <i class="fa-solid fa-cart-shopping fa-large ml-2"></i>
                </a>
            </div>
            @guest
            <div class="navbar-item">
                <div class="buttons">
                    <a href="{{ route('register') }}" class="mr-3">
                        <strong>Regístrate</strong>
                    </a>
                    o
                    <a href="{{ route('login') }}" class="ml-3">
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
    {{-- User view --}}
    @if (!isset($admin_view))
    <div class="navbar-start">
        @foreach ($animals_header as $animal_header)
        <a href="{{ route('animal', $animal_header->name) }}" class="navbar-item btn-animal">
            <img src="{{ asset("storage/images/$animal_header->image") }}" alt="Logo {{ $animal_header->name }}">
            {{ strtolower($animal_header->name) }}
        </a>            
        @endforeach
    </div>
    <div class="navbar-end">
        <div class="control has-icons-left has-icons-right">
            <form action="{{ route('search') }}" method="GET">
                <input class="input is-small search-input" name="q" type="search" placeholder="Buscar">
                <span class="icon is-small is-left">
                    <i class="fas fa-search fa-small"></i>
                </span>
            </form>
        </div>
    </div>
    {{-- Admin view --}}
    @else
    <div class="center w-100">
        @can('edit_settings')
        <a href="{{ route('products.index') }}" class="navbar-item btn-animal mx-4">
            ajustes
        </a>             
        @endcan
        @can('edit_products')
        <a href="{{ route('products.index') }}" class="navbar-item btn-animal mx-4">
            productos
        </a> 
        <a href="{{ route('categories.index') }}" class="navbar-item btn-animal mx-4">
            categorías
        </a> 
        @endcan
        @can('view_orders')
        <a href="{{ route('orders') }}" class="navbar-item btn-animal mx-4">
            pedidos
        </a>             
        @endcan
    </div>
    @endif
</nav>
    