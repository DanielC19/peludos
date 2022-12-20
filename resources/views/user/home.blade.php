@extends('layouts.template')

@section('content')
{{-- Banner promocional --}}
<section class="slide-container">
    <div class="item-slide">
        <img src="{{ asset("storage/images/img1.jpg") }}">
    </div>            
</section>

{{-- Mobile button to search for animals --}}
<div class="center mt-5">
    <a href="{{ route('animals') }}" id="animalsViewBtn" class="button is-primary">
        <p>¿como es tu peludo?</p>
        <p>(Ver categorías)</p>
    </a>
</div>

{{-- Product grid --}}
@include('layouts.products')

@endsection