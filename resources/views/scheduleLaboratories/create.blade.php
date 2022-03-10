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
                    <h3 class="mb-0">Nuevo Horario</h3>
                </div>
                <div class="col text-right">
                    <a href="{{ url('schedule') }}" class="btn btn-sm btn-default">
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
            @if (Session::get('fail'))
                <div class="alert alert-danger" role="alert">
                    {{ Session::get('fail') }}
                </div>
            @endif

            <form action="{{ url('schedule') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="laboratories">Laboratorio:</label>
                    <select name="laboratories" id="laboratories" class="form-control selectpicker"
                        data-style="btn-online-success" title="Seleccione un laboratorio">

                        @foreach ($laboratories as $laboratory)
                            @if (old('laboratories') == $laboratory->id)
                                <option value="{{ $laboratory->id }}" selected> {{ $laboratory->name }}</option>
                            @else
                                <option value="{{ $laboratory->id }}"> {{ $laboratory->name }}</option>
                            @endif

                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="laboratories">Día:</label>
                    <select name="day" class="form-control selectpicker" data-style="btn-online-success"
                        title="Seleccione un día de la semana">

                        @foreach ($days as $day)
                            @if (old('day') == $day)
                                <option value="{{ $day }}" selected> {{ $day }}</option>
                            @else
                                <option value="{{ $day }}"> {{ $day }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            <label for="name">Hora Inicio:</label>
                            <select name="time_start" class="form-control selectpicker" data-style="btn-online-success"
                                title="Seleccione una hora de inicio">
                                <option value="07:00">07:00</option>
                                <option value="08:30">08:30</option>
                                <option value="10:30">10:30</option>
                                <option value="12:00">12:00</option>
                                <option value="13:30">13:30</option>
                                <option value="15:00">15:00</option>
                                <option value="16:30">16:30</option>
                                <option value="18:30">18:30</option>
                                <option value="20:00">20:00</option>
                            </select>
                        </div>
                        <div class="col">
                            <label for="name">Hora Fin:</label>
                            <select name="time_end" class="form-control selectpicker" data-style="btn-online-success"
                                title="Seleccione una hora de fin">
                                <option value="08:30">08:30</option>
                                <option value="10:00">10:00</option>
                                <option value="12:00">12:00</option>
                                <option value="13:30">13:30</option>
                                <option value="15:00">15:00</option>
                                <option value="16:30">16:30</option>
                                <option value="18:00">18:00</option>
                                <option value="20:00">20:00</option>
                                <option value="21:30">21:30</option>
                            </select>
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
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
@endsection
