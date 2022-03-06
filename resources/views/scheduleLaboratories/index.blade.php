@extends('layouts.panel')

@section('content')
    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Horarios de Tiempo Libre de los Laboratorios de Computo</h3>
                </div>
                @if (Auth::guard('web')->check())
                    <div class="col text-right">
                        <a href="{{ url('/schedule/create') }}" class="btn btn-sm btn-success">
                            Nuevo Horario
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
                        <th scope="col">Laboratorio</th>
                        <th scope="col">Día</th>
                        <th scope="col">Hora Inicio</th>
                        <th scope="col">Hora Fin</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @foreach ($laboratories as $laboratory) --}}
                        <!--ITERAMOS LA COLECCIÓN DE DATOS -->
                        <tr>
                            <th scope="row">
                               {{-- {{ $laboratory->name }} --}} 
                            </th>
                            <th scope="row">
                               {{-- {{ $laboratory->classroom }} --}}
                            </th>
                            <th scope="row">
                               {{-- {{ $laboratory->edifice }} --}} 
                            </th>
                            <th scope="row">
                               {{-- {{ $laboratory->status }} --}} 
                            </th>
                            <td>
                                @if (Auth::guard('web')->check())
                                    <form action="#"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <a href=""
                                            class="btn btn-sm btn-primary">Editar</a>
                                        <button class="btn btn-sm btn-danger" type="submit">Eliminar</button>
                                    </form>
                                @endif

                            </td>
                        </tr>
                    {{--@endforeach  --}}
                </tbody>
            </table>
        </div>
    </div>
@endsection