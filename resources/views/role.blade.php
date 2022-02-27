@extends('layouts.form')

@section('title', 'Inicio de sesión')
@section('subtitle', 'Elige un rol para iniciar sesión')

@section('content')
    <div class="container mt--8 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-body px-lg-5 py-lg-5">

                        <div class="form-group mb-3">
                            <a href="{{ route('user.login') }}" class="btn btn-primary btn-lg btn-block">Administrador</a>
                        </div>

                        <div class="form-group mb-3">
                            <a href="{{ route('student.login') }}" class="btn btn-default btn-lg btn-block">Alumno</a>
                        </div>

                        <div class="form-group mb-3">
                            <a href="{{ route('attendant.login') }}" class="btn btn-secondary btn-lg btn-block">Encargado</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
