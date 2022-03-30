@extends('layouts.panel')

@section('content')
    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Mis Reservaciones Rechazadas</h3>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if (session('notification'))
                <div class="alert alert-success" role="alert">
                    {{ session('notification') }}
                </div>
            @endif
        </div>

        <div class="table-responsive">
            <!-- Projects table -->
            <table class="table align-items-center table-flush">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Laboratorio</th>
                        <th scope="col">Encargado</th>
                        <th scope="col">Computadora</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Hora</th>
                        <th scope="col">Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reservationsRejected as $reservation)
                        <!--ITERAMOS LA COLECCIÓN DE DATOS -->
                        <tr>
                            <th scope="row">
                                {{ $reservation->laboratory->name }}
                            </th>
                            <th scope="row">
                                {{ $reservation->attendant->name }}
                            </th>
                            <th scope="row">
                                {{ $reservation->computer->num_pc }}
                            </th>
                            <th scope="row">
                                {{ $reservation->schedule_date }}
                            </th>
                            <th scope="row">
                                {{ $reservation->schedule_time }}
                            </th>
                            <th scope="row">
                                {{ $reservation->status }}
                            </th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
