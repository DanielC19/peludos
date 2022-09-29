@extends('layouts.template')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Verifica tu email</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            Se ha enviado un nuevo link de recuperación a tu email
                        </div>
                    @endif

                    Antes de continuar, revisa tu email por un link de verificación.
                    Si no recibiste tu email...
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">enviar otro link</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
