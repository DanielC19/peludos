@extends('layouts.template')

@section('content')

<section class="section pay">
    <form action="https://checkout.wompi.co/p/" method="GET">
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
                <tr>
                    <td>Envío</td>
                    <td></td>
                    <td>${{ number_format($shipment, 0, '.', ',') }}</td>
                </tr>
            </tbody>
        </table>
        {{-- Shipment message --}}
        <article class="message is-link my-5">
            <div class="message-body has-text-centered">
                Si haces tu pedido antes del mediodía, es probable que tu pedido llegue el mismo día, de lo contrario llegará al día siguiente.
            </div>
        </article>

        <div class="my-5">
            <h3 class="mb-4">Información envío</h3>
            {{-- Inputs for shipping --}}
            @livewire('form-inputs', ['user' => $user, 'reference_code' => $wompi["reference_code"]])

            {{-- Wompi inputs for request --}}
            <!-- Mandatory -->
            <input type="hidden" name="public-key" value="{{ $wompi["public_key"] }}" />
            <input type="hidden" name="currency" value="COP" />
            <input type="hidden" name="amount-in-cents" value="{{ $wompi["amount_in_cents"] }}" />
            <input type="hidden" name="reference" value="{{ $wompi["reference_code"] }}" />
            <input type="hidden" name="signature:integrity" value="{{ $wompi["integrity_signature"] }}" />
            <!-- Optional -->
            <input type="hidden" name="redirect-url" value="{{ $wompi["redirect_url"] }}" />
            <input type="hidden" name="shipping-address:country" value="CO" />
            <input type="hidden" name="shipping-address:city" id="wcity" value="Medellín" />
            <input type="hidden" name="shipping-address:region" value="Antioquia" />

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