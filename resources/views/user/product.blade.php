@extends('layouts.template')

@section('content')
    
@livewire('product-view', ['product' => $product])

@endsection