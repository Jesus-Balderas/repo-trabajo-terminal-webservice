@extends('layouts.panel')

@section('content')
    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Registar nueva reservación</h3>
                </div>
                <div class="col text-right">
                    <a href="#" class="btn btn-sm btn-default">
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

            <form action="#" method="POST">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="laboratory">Laboratorio:</label>
                        <select name="laboratory_id" id="laboratory" class="form-control" required>
                            <option value="">Seleccionar laboratorio </option>
                            @foreach ($laboratories as $laboratory)
                                <option value="{{ $laboratory->id }}">{{ $laboratory->name }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="attendant">Encargado:</label>
                        <select name="attendant_id" id="attendant" class="form-control" required>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="date">Fecha:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                            </div>
                            <input class="form-control datepicker" placeholder="Seleccionar fecha" id="date" type="text"
                                name="scheduled_date" value="{{ date('Y-m-d') }}" data-date-format="yyyy-mm-dd"
                                data-date-start-date="{{ date('Y-m-d') }}" data-date-end-date="+15d">
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="computer">Computadoras:</label>
                        <select name="computer_id" id="computer" class="form-control" required>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="hours">Hora:</label>
                        <div id="hours">

                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">
                    Guardar
                </button>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script src={{ asset('/js/appointments/create.js') }}></script>
@endsection
