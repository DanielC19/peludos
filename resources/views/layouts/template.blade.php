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

    {{-- Livewire --}}
    @livewireStyles
</head>
<body>

@include('layouts.header')

<main>
    @yield('content')
</main>

{{-- Check cart is defined and it's not cart view --}}
@if (!isset($cart_full_view))
    @livewire('cart-fixed')    
@endif

@include('layouts.footer')

{{-- Livewire JS scripts --}}
@livewireScripts

</body>
</html>