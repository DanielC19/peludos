@extends('layouts.template')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card m-5">
                    <div class="card-header">
                        <h2 class="center w-100">
                            Detalle Pedido
                        </h2>
                        <a href="{{ route('orders') }}" class="button is-primary mr-4">
                            Atrás
                        </a>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    <div class="card-body px-6">
                        
                        <div class="form-group my-3">
                            <strong>ID (Código refencia PayU):</strong>
                            {{ $order->id }}
                        </div>
                        <div class="form-group my-3">
                            <strong>Estado:</strong>
                            {{ $order->status }}
                        </div>
                        <div class="form-group my-3">
                            <strong>Valor (con IVA):</strong>
                            ${{ number_format($order->value, 2, '.', ',') }}
                        </div>
                        <div class="form-group my-3">
                            <strong>IVA:</strong>
                            ${{ number_format($order->tax, 2, '.', ',') }}
                        </div>
                        <div class="form-group my-3">
                            <strong>ID Transacción PayU:</strong>
                            {{ $order->transaction_id }}
                        </div>
                        <div class="form-group my-3">
                            <strong>Fecha Transacción PayU:</strong>
                            {{ $order->transaction_date }}
                        </div>
                        <div class="form-group my-3">
                            <strong>Nombre Comprador:</strong>
                            {{ $order->name }}
                        </div>
                        <div class="form-group my-3">
                            <strong>Correo Comprador:</strong>
                            {{ $order->email }}
                        </div>
                        <div class="form-group my-3">
                            <strong>Celular Comprador:</strong>
                            {{ $order->cellphone }}
                        </div>
                        <div class="form-group my-3">
                            <strong>Dirección Entrega:</strong>
                            {{ $order->address }}
                        </div>
                        <div class="table-responsive form-group my-3">
                            <strong>Productos:</strong>
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>#</th>
                                        <th>ID</th>
                                        <th>Producto</th>
										<th>Presentación</th>
										<th>Valor unitario</th>
										<th>Cantidad</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->products as $product)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $product->product_id }}</td>
                                            <td>{{ $product->presentation->product->name }}</td>
											<td>{{ $product->presentation->amount}}</td>
											<td>${{ number_format($product->price, 0, '.', ',') }}</td>
											<td>{{ $product->amount}}</td>
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
