@extends('layouts.template')

@section('content')

@livewire('search', ['search' => $search])

@endsection