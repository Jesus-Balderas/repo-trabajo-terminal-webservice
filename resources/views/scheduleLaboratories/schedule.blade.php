@extends('layouts.panel')

@section('content')
    @foreach ($laboratories as $laboratory)
        <form action="{{ url('/schedule/' . $laboratory->id . '/store') }}" method="POST">
    @endforeach
    @csrf
    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Gestionar horario del {{ $laboratory->name }}</h3>
                </div>
                <div class="col text-right">
                    <button type="submit" class="btn btn-sm btn-success">
                        Guardar cambios
                    </button>
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
            <table class="table align-items-center table-flush" style="width: 50%">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Día</th>
                        <th scope="col">Activo</th>
                        <th scope="col">Primera Hora</th>
                        <th scope="col">Segunda Hora</th>
                        <th scope="col">Tercera Hora</th>
                        <th scope="col">Cuarta Hora</th>
                        <th scope="col">Quinta Hora</th>
                        <th scope="col">Sexta Hora</th>
                        <th scope="col">Septima Hora</th>
                        <th scope="col">Octava Hora</th>
                        <th scope="col">Novena Hora</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($scheduleLaboratories as $key => $schedule)
                        <tr>
                            <th>{{ $days[$key] }}</th>

                            <td>
                                <label class="custom-toggle">
                                    <!-- LOS CORCHETES PERMITEN QUE LOS DATOS SE ENVIEN AL SERVIDOR EN FORMATO DE ARREGLO -->
                                    <input type="checkbox" name="active[]" value="{{ $key }}"
                                        @if ($schedule->active) checked @endif>
                                    <span class="custom-toggle-slider rounded-circle"></span>
                                </label>
                            </td>
                            <td>
                                <div class="row">
                                    <select class="form-control" name="one_time[]">
                                        <option value="00:00" @if ('00:00:00' == $schedule->one_time) selected @endif>00:00
                                        </option>
                                        <option value="07:00" @if ('07:00:00' == $schedule->one_time) selected @endif>7:00 AM
                                        </option>
                                    </select>
                                </div>
                            </td>
                            <td>
                                <div class="row">
                                    <select class="form-control" name="two_time[]">
                                        <option value="00:00" @if ('00:00:00' == $schedule->two_time) selected @endif>00:00
                                        </option>
                                        <option value="08:30" @if ('08:30:00' == $schedule->two_time) selected @endif>8:30 AM
                                        </option>
                                    </select>
                                </div>
                            </td>
                            <td>
                                <div class="row">
                                    <select class="form-control" name="three_time[]">
                                        <option value="00:00" @if ('00:00:00' == $schedule->three_time) selected @endif>00:00
                                        </option>
                                        <option value="10:30" @if ('10:30:00' == $schedule->three_time) selected @endif>10:30 AM
                                        </option>
                                    </select>
                                </div>
                            </td>
                            <td>
                                <div class="row">
                                    <select class="form-control" name="four_time[]">
                                        <option value="00:00" @if ('00:00:00' == $schedule->four_time) selected @endif>00:00
                                        </option>
                                        <option value="12:00" @if ('12:00:00' == $schedule->four_time) selected @endif>12:00 PM
                                        </option>
                                    </select>
                                </div>
                            </td>
                            <td>
                                <div class="row">
                                    <select class="form-control" name="five_time[]">
                                        <option value="00:00" @if ('00:00:00' == $schedule->five_time) selected @endif>00:00
                                        </option>
                                        <option value="13:30" @if ('13:30:00' == $schedule->five_time) selected @endif>1:30 PM
                                        </option>
                                    </select>
                                </div>
                            </td>
                            <td>
                                <div class="row">
                                    <select class="form-control" name="six_time[]">
                                        <option value="00:00" @if ('00:00:00' == $schedule->six_time) selected @endif>00:00
                                        </option>
                                        <option value="15:00" @if ('15:00:00' == $schedule->six_time) selected @endif>3:00 PM
                                        </option>
                                    </select>
                                </div>
                            </td>
                            <td>
                                <div class="row">
                                    <select class="form-control" name="seven_time[]">
                                        <option value="00:00" @if ('00:00:00' == $schedule->seven_time) selected @endif>00:00
                                        </option>
                                        <option value="16:30" @if ('16:30:00' == $schedule->seven_time) selected @endif>4:30 PM
                                        </option>
                                    </select>
                                </div>
                            </td>
                            <td>
                                <div class="row">
                                    <select class="form-control" name="eight_time[]">
                                        <option value="00:00" @if ('00:00:00' == $schedule->eight_time) selected @endif>00:00
                                        </option>
                                        <option value="18:30" @if ('18:30:00' == $schedule->eight_time) selected @endif>6:30 PM
                                        </option>
                                    </select>
                                </div>
                            </td>
                            <td>
                                <div class="row">
                                    <select class="form-control" name="nine_time[]">
                                        <option value="00:00" @if ('00:00:00' == $schedule->nine_time) selected @endif>00:00
                                        </option>
                                        <option value="20:00" @if ('20:00:00' == $schedule->nine_time) selected @endif>8:00 PM
                                        </option>
                                    </select>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </form>

@endsection
