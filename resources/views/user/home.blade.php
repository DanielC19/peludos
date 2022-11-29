@extends('layouts.template')

@section('content')
{{-- Banner promocional --}}
<section class="slide-container">
    <input type="radio" id="1" name="image-slide" hidden/>
    <input type="radio" id="2" name="image-slide" hidden/>
    <input type="radio" id="3" name="image-slide" hidden/>

    <div class="slide">
        @for ($i = 1; $i <= 3; $i++)
        <div class="item-slide">
            <img src="{{ asset("storage/images/img$i.jpg") }}">
        </div>            
        @endfor
    </div>

    <div class="banner-pagination"> 
        @for ($i = 1; $i <= 3; $i++)
        <label class="pagination-item" for="{{ $i }}">
            <img src="{{ asset("storage/images/img$i.jpg") }}">
        </label>              
        @endfor 
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