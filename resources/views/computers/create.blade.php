@extends('layouts.panel')

@section('content')
    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Computadoras</h3>
                </div>
                <div class="col text-right">
                    <a href="" class="btn btn-sm btn-default">
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

            <form action="{{ url('/laboratory/computers') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="laboratories">Laboratorio:</label>
                    <select name="laboratories" id="laboratories" class="form-control selectpicker"
                        data-style="btn-online-success" title="Seleccione un encargado">
                        @foreach ($laboratories as $laboratory)
                            <option value="{{ $laboratory->id }}" selected> {{ $laboratory->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="edifice">Computadoras:</label>
                    <input type="number" name="computers" class="form-control" value="{{ old('computers') }}" required>
                </div>
                <button type="submit" class="btn btn-primary">
                    Guardar
                </button>
            </form>
        </div>
    </div>
@endsection
