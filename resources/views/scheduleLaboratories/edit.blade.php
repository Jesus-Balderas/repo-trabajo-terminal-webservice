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
                    <h3 class="mb-0">Editar Horario</h3>
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

            <form action="{{ url('schedule/'.$schedule->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="laboratories">Laboratorio:</label>
                    <select name="laboratories" id="laboratories" class="form-control selectpicker"
                        data-style="btn-online-success" title="Seleccione un laboratorio">

                        @foreach ($laboratories as $laboratory)
                            <option value="{{ $laboratory->id }}"> {{ $laboratory->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="laboratories">Día:</label>
                    <select name="day" class="form-control selectpicker" data-style="btn-online-success"
                        title="Seleccione un día de la semana">

                        @foreach ($days as $day)
                            @if ($day == $schedule->day)
                                <option value="{{ $day }}" selected> {{ $day }}</option>
                            @endif
                            <option value="{{ $day }}"> {{ $day }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            <label for="time_start">Hora Inicio:</label>
                            <select name="time_start" class="form-control selectpicker" data-style="btn-online-success"
                                title="Seleccione una hora de inicio">
                                <option value="07:00" @if('07:00:00' == $schedule->time_start)
                                    selected
                                @endif>07:00</option>
                                <option value="08:30"@if('08:30:00' == $schedule->time_start)
                                    selected
                                @endif>08:30</option>
                                <option value="10:30"@if('10:30:00' == $schedule->time_start)
                                    selected
                                @endif>10:30</option>
                                <option value="12:00"@if('12:00:00' == $schedule->time_start)
                                    selected
                                @endif>12:30</option>
                                <option value="13:30"@if('13:30:00' == $schedule->time_start)
                                    selected
                                @endif>13:30</option>
                                <option value="15:00"@if('15:00:00' == $schedule->time_start)
                                    selected
                                @endif>15:00</option>
                                <option value="16:30"@if('16:30:00' == $schedule->time_start)
                                    selected
                                @endif>16:30</option>
                                <option value="18:30"@if('18:30:00' == $schedule->time_start)
                                    selected
                                @endif>18:30</option>
                                <option value="20:00"@if('20:00:00' == $schedule->time_start)
                                    selected
                                @endif>20:00</option>
                            </select>
                        </div>
                        <div class="col">
                            <label for="time_end">Hora Fin:</label>
                            <select name="time_end" class="form-control selectpicker"
                                data-style="btn-online-success" title="Seleccione una hora de fin">
                                <option value="08:30" @if('08:30:00' == $schedule->time_end)
                                    selected
                                @endif>08:30</option>
                                <option value="10:00" @if('10:00:00' == $schedule->time_end)
                                    selected
                                @endif>10:00</option>
                                <option value="12:00" @if('12:00:00' == $schedule->time_end)
                                    selected
                                @endif>12:00</option>
                                <option value="13:30" @if('13:30:00' == $schedule->time_end)
                                    selected
                                @endif>13:30</option>
                                <option value="15:00" @if('15:00:00' == $schedule->time_end)
                                    selected
                                @endif>15:00</option>
                                <option value="16:30" @if('16:30:00' == $schedule->time_end)
                                    selected
                                @endif>16:30</option>
                                <option value="18:00" @if('18:00:00' == $schedule->time_end)
                                    selected
                                @endif>18:00</option>
                                <option value="20:00" @if('20:00:00' == $schedule->time_end)
                                    selected
                                @endif>20:00</option>
                                <option value="21:30" @if('21:30:00' == $schedule->time_end)
                                    selected
                                @endif>21:30</option>
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
    <script>
        //Esta función se ejecuta una vez que la página se ha cargado
        $(document).ready(() => {
            $('#laboratories').selectpicker('val', @json($laboratory_ids));
        });
    </script>
@endsection
