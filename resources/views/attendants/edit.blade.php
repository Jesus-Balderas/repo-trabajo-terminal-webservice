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
                    <h3 class="mb-0">Editar Encargado</h3>
                </div>
                <div class="col text-right">
                    <a href="{{ url('attendants') }}" class="btn btn-sm btn-default">
                        Cancelar y volver
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">

            @if($errors->any())
               <div class="alert alert-danger" role="alert">
                 <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                 </ul>                   
               </div>                
            @endif
            
            <form action="{{ url('attendants/'.$attendant->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="num_empleado"> Número de Empleado</label>
                    <input type="text" name="num_empleado" class="form-control" value="{{ old('num_empleado', $attendant->num_empleado) }}" required>
                </div>

                <div class="form-group">
                    <label for="name"> Nombre</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $attendant->name) }}" required>
                </div>
                <div class="form-group">
                    <label for="first_name"> Primer Apellido</label>
                    <input type="text" name="first_name" class="form-control" value="{{ old('first_name', $attendant->first_name) }}" required>
                </div>
                <div class="form-group">
                    <label for="second_name"> Segundo Apellido</label>
                    <input type="text" name="second_name" class="form-control" value="{{ old('second_name', $attendant->second_name) }}" required>
                </div>

                <div class="form-group">
                    <label for="email"> Email</label>
                    <input type="text" name="email" class="form-control" value="{{ old('email', $attendant->email) }}" required>
                </div>

                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="text" name="password" class="form-control" value="">
                    <p>Ingrese un valor solo si desea modificar la contraseña</p>
                </div>

                <div class="form-group">
                    <label for="laboratories">Laboratorio</label>
                    <select name="laboratories" id="laboratories" class="form-control selectpicker" 
                            data-style="btn-online-success" title="Seleccione un laboratorio">
                            
                        @foreach($laboratories as $laboratory)
                            <option value="{{ $laboratory->id }}"> {{ $laboratory->name }}</option>
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
<script>
    //Esta función se ejecuta una vez que la página se ha cargado
    $(document).ready(() => {
        $('#laboratories').selectpicker('val', @json($laboratory_ids));
    });
</script>
@endsection