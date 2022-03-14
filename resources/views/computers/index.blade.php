@extends('layouts.panel')

@section('content')
    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                @foreach ($laboratories as $laboratory)
                    <div class="col">
                        <h3 class="mb-0">Computadoras del {{ $laboratory->name }}</h3>
                        <h3 class="mb-0">Cantidad: {{ $computerCount }}</h3>
                    </div>
                    @if (Auth::guard('web')->check())
                        <div class="col text-right">
                            <a href="{{ url('/laboratory/computers/' . $laboratory->id) . '/create' }}"
                                class="btn btn-sm btn-success">
                                Agregar Computadoras
                            </a>
                        </div>
                    @endif
                @endforeach
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
                        <th scope="col">Numero de PC</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($computers as $computer)
                        <!--ITERAMOS LA COLECCIÓN DE DATOS -->
                        <tr>
                            <th scope="row">
                                {{ $computer->num_pc }}
                            </th>
                            <th scope="row">
                                {{ $computer->status }}
                            </th>
                            <td>
                                <form action="{{ url('/laboratory/computers/'. $computer->id .'/delete') }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" type="submit">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {!! $computers->links() !!}
            </div>
        </div>
    </div>
@endsection
