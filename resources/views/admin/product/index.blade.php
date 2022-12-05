@extends('layouts.template')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card m-5">
                    <div class="card-header">
                        <h2 class="center w-100">
                            Productos
                        </h2>
                        <a href="{{ route('products.create') }}" class="button is-primary">
                            Añadir
                        </a>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>#</th>
                                        <th>ID</th>
										<th>Animal</th>
										<th>Categoría</th>
										<th>Producto</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $product->id }}</td>
											<td>{{ $product->category->animal->name }}</td>
											<td>{{ $product->category->name }}</td>
											<td>{{ $product->name }}</td>
                                            <td>
                                                @if ($product->availability)
                                                <a class="button btn btn-sm is-secondary" href="{{ route('products.available',$product->id) }}"><i class="fa fa-fw fa-eye"></i> Disponible</a>                                                    
                                                @else
                                                <a class="button btn btn-sm btn-danger" href="{{ route('products.available',$product->id) }}"><i class="fa-solid fa-eye-slash"></i> Agotado</a>
                                                @endif
                                                <a class="button btn btn-sm is-primary" href="{{ route('products.show',$product->id) }}"><i class="fa-solid fa-magnifying-glass"></i> Detalle</a>
                                                <a class="button btn btn-sm btn-primary" href="{{ route('products.edit',$product->id) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $products->links() !!}
            </div>
        </div>
    </div>
@endsection
