@extends('layouts.template')

@section('content')

<h2 class="title is-2 center my-5">{{ $category->animal->name }}</h2>

{{-- Categories --}}
<section class="categories center">
    @foreach ($category->animal->categories as $category_filters)
        @if ($category_filters->id == $category->id)
            <a href="{{ route('category', $category_filters->id) }}" class="button is-primary is-rounded m-2"><i class="fa-solid fa-bone mr-2"></i>{{ $category_filters->name }}</a>    
        @else
            <a href="{{ route('category', $category_filters->id) }}" class="button is-rounded m-2"><i class="fa-solid fa-bone mr-2"></i>{{ $category_filters->name }}</a>
        @endif
    @endforeach
</section>

@include('layouts.products')

@endsection