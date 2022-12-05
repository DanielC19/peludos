@extends('layouts.template')

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card m-5">
                    <div class="card-header">
                        <h2 class="center w-100">
                            Editar Presentación
                        </h2>
                        <a href="{{ route('products.show', $presentation->product->id) }}" class="button is-primary">
                            Atrás
                        </a>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('presentations.update') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('admin.presentation.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
