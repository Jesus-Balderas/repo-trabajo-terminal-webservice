@extends('layouts.panel')

@section('content')
    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Laboratorios</h3>
                </div>
                <div class="col text-right">
                    <a href="{{ url('laboratories/create') }}" class="btn btn-sm btn-success">
                        Nuevo Laboratorio
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if(session('notification'))
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
                        <th scope="col">Nombre</th>
                        <th scope="col">Salón</th>
                        <th scope="col">Edificio</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($laboratories as $laboratory) <!--ITERAMOS LA COLECCIÓN DE DATOS -->
                        <tr>
                            <th scope="row">
                                {{ $laboratory->name }}
                            </th>
                            <th scope="row">
                                {{ $laboratory->classroom }}
                            </th>
                            <th scope="row">
                                {{ $laboratory->edifice }}
                            </th>
                            <th scope="row">
                                {{ $laboratory->status }}
                            </th>
                            <td>
                                <form action="{{ url('/laboratories/'.$laboratory->id.'/delete') }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <a href="files/{{ $laboratory->file_path }}" target="blank_" class="btn btn-sm btn-success">Ver Horario</a>
                                    <a href="{{ url('/laboratories/'.$laboratory->id.'/edit') }}" class="btn btn-sm btn-primary">Editar</a>
                                    <button class="btn btn-sm btn-danger" type="submit">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection