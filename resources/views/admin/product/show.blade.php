@extends('layouts.template')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card m-5">
                    <div class="card-header">
                        <h2 class="center w-100">
                            Detalle Producto
                        </h2>
                        <a href="{{ route('products.index') }}" class="button is-primary mr-4">
                            Atrás
                        </a>
                        <a href="{{ route('presentations.create', $product->id) }}" class="button is-secondary">
                            Añadir
                        </a>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    <div class="card-body px-6">
                        
                        <div class="form-group my-3">
                            <strong>Animal:</strong>
                            {{ $product->category->animal->name }}
                        </div>
                        <div class="form-group my-3">
                            <strong>Categoría:</strong>
                            {{ $product->category->name }}
                        </div>
                        <div class="form-group my-3">
                            <strong>Producto:</strong>
                            {{ $product->name }}
                        </div>
                        <div class="form-group my-3">
                            <strong>Imagen:</strong>
                            <br>
                            <img src="{{ asset('storage/'.$product->image) }}" alt="Imagen del producto" width="250px">
                        </div>
                        <div class="table-responsive form-group my-3">
                            <strong>Presentaciones:</strong>
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>#</th>
                                        <th>ID</th>
										<th>Presentación</th>
										<th>Precio</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($product->presentations as $presentation)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $presentation->id }}</td>
											<td>{{ $presentation->amount}}</td>
											<td>${{ number_format($presentation->price, 0, '.', ',') }}</td>
                                            <td>
                                                @if ($presentation->availability)
                                                <a class="button btn btn-sm is-secondary" href="{{ route('presentations.available',$presentation->id) }}"><i class="fa fa-fw fa-eye"></i> Disponible</a>                                                    
                                                @else
                                                <a class="button btn btn-sm btn-danger" href="{{ route('presentations.available',$presentation->id) }}"><i class="fa-solid fa-eye-slash"></i> Agotado</a>
                                                @endif
                                                <a class="btn btn-sm btn-primary" href="{{ route('presentations.edit',$presentation->id) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
