@extends('layouts.panel')

@section('content')
    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Reservaciones</h3>
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
                    @foreach ($reservations as $reservation)
                        <!--ITERAMOS LA COLECCIÓN DE DATOS -->
                        <tr>
                            <th scope="row">
                                {{ $reservation->boleta }}
                            </th>
                            <th scope="row">
                                {{ $reservation->student }}
                            </th>
                            <th scope="row">
                                {{ $reservation->num_pc }}
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
                                    <form action="{{ url('/attendants/' . $reservation->id . '/delete') }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" type="submit">Rechazar</button>
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
