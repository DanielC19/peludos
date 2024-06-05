@extends('layouts.template')

@section('content')
    
@livewire('product-admin', ['products' => $products])

@endsection
