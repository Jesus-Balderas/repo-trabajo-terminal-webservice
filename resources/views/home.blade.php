@extends('layouts.panel')

@section('content')
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card">
                <div class="card-header">{{ __('Panel de Inicio') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    ¡Bienvenido! Por favor selecciona una opción del menú lateral izquierdo.
                </div>
            </div>
        </div>
    </div>
@endsection
