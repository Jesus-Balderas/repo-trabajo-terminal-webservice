@extends('layouts.panel')

@section('content')
    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Encargados</h3>
                </div>
                @if (Auth::guard('web')->check())
                    <div class="col text-right">
                        <a href="{{ url('attendants/create') }}" class="btn btn-sm btn-success">
                            Nuevo Encargado
                        </a>
                    </div>
                @endif

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
                        <th scope="col">Número de Empleado</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Primer Apellido</th>
                        <th scope="col">Segundo Apellido</th>
                        <th scope="col">Email</th>
                        <th scope="col">Laboratorio</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($attendants as $attendant)
                        <!--ITERAMOS LA COLECCIÓN DE DATOS -->
                        <tr>
                            <th scope="row">
                                {{ $attendant->num_empleado }}
                            </th>
                            <th scope="row">
                                {{ $attendant->name }}
                            </th>
                            <th scope="row">
                                {{ $attendant->first_name }}
                            </th>
                            <th scope="row">
                                {{ $attendant->second_name }}
                            </th>
                            <th scope="row">
                                {{ $attendant->email }}
                            </th>
                            <th scope="row">
                                {{ $attendant->laboratory->name }}
                            </th>
                            <td>
                                @if (Auth::guard('web')->check())
                                    <form action="{{ url('/attendants/' . $attendant->id . '/delete') }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{ url('/attendants/' . $attendant->id . '/edit') }}"
                                            class="btn btn-sm btn-primary">Editar</a>
                                        <button class="btn btn-sm btn-danger" type="submit">Eliminar</button>
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
