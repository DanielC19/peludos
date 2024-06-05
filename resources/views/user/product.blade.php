@extends('layouts.template')

@section('content')
    
@livewire('product-view', ['product' => $product])

{{-- Include grid of related products --}}
<div class="center mx-4">
    <h3 class="title is-3">También te puede interesar...</h3>
</div>
@include('layouts.products')

@endsection