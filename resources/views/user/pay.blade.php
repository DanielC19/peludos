@extends('layouts.template')

@section('content')

<section class="section pay">
    <form action="https://sandbox.checkout.payulatam.com/ppp-web-gateway-payu/" method="POST">
        <div class="center mb-5">
            <a href="{{ route('cart') }}" class="button is-primary is-rounded is-medium">Volver al carrito</a>
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
        <div class="my-5">
            <h3 class="mb-4">Información envío</h3> 
            {{-- Inputs for shipping --}}
            @livewire('form-inputs', ['user' => $user, 'reference_code' => $payU["reference_code"]])                                             
            {{-- PayU inputs for request --}}
            <input name="merchantId"      type="hidden"  value="{{ $payU["merchant_id"] }}">
            <input name="accountId"       type="hidden"  value="{{ $payU["account_id"] }}">
            <input name="description"     type="hidden"  value="Compra de artículo(s) en Peludos">
            <input name="referenceCode"   type="hidden"  value="{{ $payU["reference_code"] }}">
            <input name="amount"          type="hidden"  value="{{ $total_price }}">
            <input name="currency"        type="hidden"  value="COP">
            <input name="signature"       type="hidden"  value="{{ $payU["signature"] }}">
            <input name="test"            type="hidden"  value="1"> {{-- 0: PROD / 1: SANDBOX --}}
            <input name="shippingCity"    type="hidden"  value="Medellín">
            <input name="shippingCountry" type="hidden"  value="CO">
            <input name="responseUrl"     type="hidden"  value="{{ $payU["response_url"] }}">
            <input name="confirmationUrl" type="hidden"  value="{{ $payU["confirmation_url"] }}">
            {{-- User message --}}
            <article class="message is-link mt-5">
                <div class="message-body has-text-centered">
                    Recuerda que si estás registrado en <b>peludos</b> recordaremos toda tu info de envío para que sea más rápida tu siguiente compra ;)
                </div>
            </article>
        </div>
        @livewire('form-submit')
    </form>
</section>

@endsection