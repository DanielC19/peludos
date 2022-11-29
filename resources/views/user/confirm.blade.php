@extends('layouts.template')

@section('content')
    
<section class="section pay">
    <div class="center">
        <h1 class="mb-6">¡Tu pago ha sido exitoso!</h1>
    </div>
    <table class="table">
        <h3>Resumen Compra</h3>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Total:</th>
                <th>{{ $total_amount }}</th>
                <th>${{ number_format($total_price, 0, '.', ',') }}</th>
            </tr>
        </tfoot>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->name.' '.$product->presentation->amount }}</td>
                    <td>{{ $product->amount }}</td>
                    <td>${{ number_format($product->price, 0, '.', ',') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <h3 class="mt-5 mb-4">Info envío</h3>
    <ul style="list-style: disc">
        <li><strong>Nombre:</strong> {{ $order->name }}</li>
        <li><strong>Email:</strong> {{ $order->email }}</li>
        <li><strong>Celular:</strong> {{ $order->cellphone }}</li>
        <li><strong>Dirección:</strong> {{ $order->address }}</li>
    </ul>
    <div class="center mt-6">
        <a href="{{ route('home') }}" class="button is-primary is-rounded is-medium">Seguir comprando</a>
    </div>
</section>

@endsection