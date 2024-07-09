@extends('layouts.template')

@section('content')

<section class="container card px-5 py-4 my-5">
    <div class="my-3">
        <h4>Mi código de referido: {{ Auth::id() }}</h4>
    </div>
    <hr>
    <div class="my-3">
        <h4>Mi Saldo: ${{ number_format(Auth::user()->balance, 0, '.', ',') }}</h4>
    </div>
    <hr>
    <div class="my-3">
        <h4 class="mb-3">Actualizar datos</h4>
        <form action="{{ route('account.update') }}" method="POST">
            @csrf
            <div class="columns">
                <div class="field column is-half-desktop">
                    <label class="label">Nombre</label>
                    <div class="control">
                        <input class="input @error('name') is-invalid @enderror" name="name" type="text" value="{{ Auth::user()->name }}" placeholder="Actualiza tu nombre">
                    </div>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="columns">
                <div class="field column is-half-desktop">
                    <label class="label">Teléfono (solo Colombia)</label>
                    <div class="control">
                        <input class="input @error('cellphone') is-invalid @enderror" name="cellphone" type="text" value="{{ Auth::user()->cellphone }}" placeholder="Actualiza tu teléfono">
                    </div>
                    @error('cellphone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="columns">
                <div class="field column is-half-desktop">
                    <label class="label">Dirección</label>
                    <div class="control">
                        <input class="input @error('address') is-invalid @enderror" name="address" type="text" value="{{ Auth::user()->address }}" placeholder="Actualiza tu dirección">
                    </div>
                    @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="columns">
                <div class="field column is-half-desktop">
                    <label class="label">Contraseña</label>
                    <div class="control">
                        <input class="input @error('password') is-invalid @enderror" name="password" type="password" placeholder="Actualiza tu contraseña">
                    </div>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="columns">
                <div class="field column is-half-desktop">
                    <label class="label">Confirmar contraseña</label>
                    <div class="control">
                        <input class="input" name="password_confirmation" type="password" placeholder="Confirma tu contraseña">
                    </div>
                </div>
            </div>
            <div class="field">
                <div class="control">
                    <button class="button is-primary" type="submit">Actualizar</button>
                </div>
            </div>
        </form>
    </div>
</section>

@endsection