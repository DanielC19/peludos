@extends('layouts.template')

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card m-5">
                    <div class="card-header">
                        <h2 class="center w-100">
                            Editar Producto
                        </h2>
                        <a href="{{ url()->previous() }}" class="button is-primary">
                            Atrás
                        </a>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('products.update', $product->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @livewire('product-form', ['animals' => $animals, 'product' => $product])

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
