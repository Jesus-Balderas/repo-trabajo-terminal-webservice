@extends('layouts.panel')

@section('content')
    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Editar Laboratorio</h3>
                </div>
                <div class="col text-right">
                    <a href="{{ url('laboratories') }}" class="btn btn-sm btn-default">
                        Cancelar y volver
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ url('laboratories/'.$laboratory->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">Nombre del laboratorio:</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $laboratory->name) }}" required>
                </div>
                <div class="form-group">
                    <label for="classroom">Salón:</label>
                    <input type="text" name="classroom" class="form-control" value="{{ old('classroom', $laboratory->classroom) }}" required>
                </div>
                <div class="form-group">
                    <label for="edifice">Edificio:</label>
                    <input type="number" name="edifice" class="form-control" value="{{ old('edifice', $laboratory->edifice) }}" required>
                </div>
                <div class="form-group">
                    <div class="mb-3">
                        <label for="file_path" class="form-label">Horario:</label>
                        <input class="form-control" type="file" name="file_path" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">
                    Guardar
                </button>
            </form>
        </div>
    </div>
@endsection