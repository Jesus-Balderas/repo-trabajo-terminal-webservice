@extends('layouts.panel')

@section('content')
    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Alumnos</h3>
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
                        <th scope="col">Número de Boleta</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Primer Apellido</th>
                        <th scope="col">Segundo Apellido</th>
                        <th scope="col">Email</th>
                        <th scope="col">Carrera</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                        <!--ITERAMOS LA COLECCIÓN DE DATOS -->
                        <tr>
                            <th scope="row">
                                {{ $student->num_boleta }}
                            </th>
                            <th scope="row">
                                {{ $student->name }}
                            </th>
                            <th scope="row">
                                {{ $student->first_name }}
                            </th>
                            <th scope="row">
                                {{ $student->second_name }}
                            </th>
                            <th scope="row">
                                {{ $student->email }}
                            </th>
                            <th scope="row">
                                {{ $student->career->name }}
                            </th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
