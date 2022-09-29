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
            <img src="{{ Vite::asset("resources/img/img$i.jpg") }}">
        </div>            
        @endfor
    </div>

    <div class="pagination"> 
        @for ($i = 1; $i <= 3; $i++)
        <label class="pagination-item" for="{{ $i }}">
            <img src="{{ Vite::asset("resources/img/img$i.jpg") }}">
        </label>              
        @endfor 
    </div>
</section>

{{--  --}}
@include('layouts.products')

@endsection