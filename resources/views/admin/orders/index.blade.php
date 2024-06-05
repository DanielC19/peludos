@extends('layouts.template')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card m-5">
                    <div class="card-header">
                        <h2 class="center w-100">
                            Pedidos
                        </h2>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    @if ($message = Session::get('danger'))
                        <div class="alert alert-danger">
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
										<th>Estado Transacción</th>
										<th>Valor</th>
										<th>Comprador</th>
										<th>Fecha</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $order->id }}</td>
											<td>{{ $order->status }}</td>
											<td>${{ number_format($order->value, 0, '.', ',') }}</td>
											<td>{{ $order->name }}</td>
											<td>{{ $order->created_at }}</td>
                                            <td>
                                                <a class="button btn btn-sm is-primary" href="{{ route('orders.show', $order->id) }}"><i class="fa-solid fa-magnifying-glass"></i> Detalle</a>
                                                @if ($order->delivered)
                                                <a class="button btn btn-sm is-secondary" href="{{ route('orders.deliver',$order->id) }}"><i class="fa-solid fa-check-to-slot"></i> Entregado</a>                                                    
                                                @else
                                                <a class="button btn btn-sm btn-danger" href="{{ route('orders.deliver',$order->id) }}"><i class="fa-solid fa-rectangle-xmark"></i> Sin entregar</a>
                                                @endif                                            
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $orders->links() !!}
            </div>
        </div>
    </div>
@endsection