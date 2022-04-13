@extends('layouts.panel')

@section('content')
    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Reservaciones Aceptadas</h3>
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
                        <th scope="col">Boleta</th>
                        <th scope="col">Alumno</th>
                        <th scope="col">Computadora</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Hora</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reservationsAccepted as $reservation)
                        <!--ITERAMOS LA COLECCIÓN DE DATOS -->
                        <tr>
                            <th scope="row">
                                {{ $reservation->student->num_boleta }}
                            </th>
                            <th scope="row">
                                {{ $reservation->student->name }}
                            </th>
                            <th scope="row">
                                {{ $reservation->computer->num_pc }}
                            </th>
                            <th scope="row">
                                {{ $reservation->status }}
                            </th>
                            <th scope="row">
                                {{ $reservation->schedule_date }}
                            </th>
                            <th scope="row">
                                {{ $reservation->schedule_time }}
                            </th>
                            <td>
                                @if (Auth::guard('attendant')->check())
                                    <form action="{{ url('/reservations/attendant/' . $reservation->id . '/finish') }}"
                                        method="POST" class="d-inline-block">
                                        @csrf
                                        <button class="btn btn-sm btn-warning" type="submit">Finalizar</button>
                                    </form>
                                @endif

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
