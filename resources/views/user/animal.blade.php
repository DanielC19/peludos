@extends('layouts.template')

@section('content')

<h2 class="title is-2 center my-5">{{ $animal->name }}</h2>

{{-- Categories --}}
<section class="is-flex-wrap-wrap center">
    @foreach ($animal->categories as $category)
        <a href="{{ route('category', $category->id) }}" class="button is-rounded m-2"><i class="fa-solid fa-bone mr-2"></i>{{ $category->name }}</a>
    @endforeach
</section>

@include('layouts.products')

@endsection