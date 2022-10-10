@extends('layouts.template')

@section('content')
    
<h2 class="title is-2 center mt-4 mb-3">Carrito de compras</h2>

{{-- Shopping Cart --}}
@if (count($products) != 0)
    <section class="shopping-cart">
        @foreach ($products as $product)
            @livewire('cart-product', ['product' => $product], key($product->id))
        @endforeach
    </section>
@else
    <section class="section center is-flex-direction-column my-3">
        <p class="is-size-4">No tienes ningún producto en el carrito de compras :(</p>
        <p class="is-size-4">¡Haz click para encontrar el producto que necesitas para tu mascota!</p>
        <a href="{{ route('home') }}" class="button is-primary is-medium mt-4">Ver productos</a>
    </section>
@endif

@endsection