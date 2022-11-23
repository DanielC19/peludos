@extends('layouts.template')

@section('content')

<section class="animals section center">
    @foreach ($animals as $animal)
        <a href="{{ route('animal', $animal->name) }}" class="button">
            <img src="{{ asset("storage/images/$animal->image") }}" alt="Logo {{ $animal->name }}">
            <p>{{ strtolower($animal->name) }}</p>
        </a>
    @endforeach
</section>
    
@endsection