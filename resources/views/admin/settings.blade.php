@extends('layouts.template')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card m-5">
                    <div class="card-header">
                        <h2 class="center w-100">
                            Ajustes
                        </h2>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    <div class="card-body">
                        <form method="POST" action="{{ route('settings.update') }}" role="form" enctype="multipart/form-data">
                            @csrf
                            <div class="box box-info padding-1">
                                <div class="box-body">
                                    <div class="field mb-3">
                                        <label for="shipment" class="label">Envío</label>
                                        <div class="control">
                                            <input type="text" name="shipment" id="price-input" class="input" value="${{ number_format($settings->shipment, 0, '.', ',') }}">
                                        </div>
                                    </div>
                                    <div class="field mb-3">
                                        <label for="rise" class="label">Aumento por producto (%)</label>
                                        <div class="control">
                                            <input type="number" name="rise" class="input" value="{{ $settings->rise }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer mt-4">
                                    <button type="submit" class="button is-primary">Actualizar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
