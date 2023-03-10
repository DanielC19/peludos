<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="title" content="Peludos">
    <meta name="description" content="Encuentra todo para tu mascota en un solo lugar. Llegamos hasta la comodidad de tu hogar.">
    <meta name="keywords" content="mascotas, animales, perro, perros, gato, gatos, cuido, alimento, comida, salud, higiene, accesorios, juguetes, productos, tienda">
    <meta name="robots" content="index, follow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="Spanish">
  
    <meta http-equiv='cache-control' content='no-cache'>
    <meta http-equiv='expires' content='0'>
    <meta http-equiv='pragma' content='no-cache'>
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    {{-- Manifest of PWA --}}
    <link rel="manifest" href="{{ asset('/manifest.json') }}">
    
    <title>Peludos | Todo para tu mascota</title>
    <link rel="shortcut icon" href="{{ asset('storage/images/square-icon.png') }}" type="image/x-icon">

    {{-- Import Bulma --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    {{-- Import FontAwesome --}}
    <script src="https://kit.fontawesome.com/c04f1e2916.js" crossorigin="anonymous"></script>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('/build/assets/app.bd4110fb.css') }}">

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

{{-- PWA / Service worker scripts --}}
<script src="{{ asset('/build/assets/app.b3decae5.js') }}"></script>
<script src="{{ asset('/sw.js') }}"></script>
<script>
    if (!navigator.serviceWorker.controller) {
        navigator.serviceWorker.register("/sw.js").then(function (reg) {
            console.log("Service worker has been registered for scope: " + reg.scope);
        });
    }
</script>
</body>
</html>