@extends('layouts.panel')
@section('styles')
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

@endsection
@section('content')
    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Nuevo Laboratorio</h3>
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

            <form action="{{ url('laboratories') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">Nombre del laboratorio:</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                </div>
                <div class="form-group">
                    <label for="classroom">Salón:</label>
                    <input type="text" name="classroom" class="form-control" value="{{ old('classroom') }}" required>
                </div>
                <div class="form-group">
                    <label for="edifice">Edificio:</label>
                    <input type="number" name="edifice" class="form-control" value="{{ old('edifice') }}" required>
                </div>
                <div class="form-group">
                    <label for="edifice">Computadoras:</label>
                    <input type="number" name="computers" class="form-control" value="{{ old('computers') }}" required>
                </div>
                <div class="form-group">
                    <div class="mb-3">
                        <label for="file_path" class="form-label">Horario:</label>
                        <input class="form-control" type="file" name="file_path" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="attendants">Encargado:</label>
                    <select name="attendants" id="attendants" class="form-control selectpicker"
                        data-style="btn-online-success" title="Seleccione un encargado">

                        @foreach ($attendants as $attendant)
                            @if (old('attendants') == $attendant->id)
                                <option value="{{ $attendant->id }}" selected> {{ $attendant->name }}</option>
                            @else
                                <option value="{{ $attendant->id }}"> {{ $attendant->name }}</option>
                            @endif

                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">
                    Guardar
                </button>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
@endsection