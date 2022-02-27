@extends('layouts.form')

@section('title', 'Inicio de sesión')
@section('subtitle', 'Ingresa tus datos para iniciar sesión como encargado de laboratorio')

@section('content')
<div class="container mt--8 pb-5">
    <div class="row justify-content-center">
      <div class="col-lg-5 col-md-7">
        <div class="card bg-secondary shadow border-0">
          <div class="card-body px-lg-5 py-lg-5">
            
            @if($errors->any())
                <div class="alert alert-danger" role="alert">
                     {{ $errors->first() }}
                </div>
            @endif

            @if(Session::get('fail'))
            <div class="alert alert-danger" role="alert">
                {{ Session::get('fail') }}
           </div>
            @endif

            <form method="POST" action="{{ route('attendant.check') }}">
                @csrf
                
              <div class="form-group mb-3">
                <div class="input-group input-group-alternative">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                  </div>
                  <input class="form-control" placeholder="Número de empleado" type="text" name="num_empleado" value="{{ old('num_empleado') }}" required>
                </div>
              </div>

              <div class="form-group">
                <div class="input-group input-group-alternative">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                  </div>
                  <input class="form-control" placeholder="Contraseña" type="password" name="password" required autocomplete="current-password">
                </div>
              </div>

              <div class="custom-control custom-control-alternative custom-checkbox">
                <input name="remember" class="custom-control-input" id=" remember" type="checkbox"
                    {{ old('remember') ? 'checked' : '' }} >
                <label class="custom-control-label" for=" remember">
                  <span class="text-muted">Recordar sesión</span>
                </label>
              </div>
              <div class="text-center">
                <button type="submit" class="btn btn-primary my-4">Ingresar</button>
              </div>

            </form>

          </div>
        </div>
        <div class="row mt-3">
          <div class="col-6">
            <a href="{{ route('password.request') }}" class="text-light">
                <small>¿Olvidaste tu contraseña?</small></a>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection