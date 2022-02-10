@extends('layouts.panel')

@section('content')
    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Editar Carrera</h3>
                </div>
                <div class="col text-right">
                    <a href="{{ url('careers') }}" class="btn btn-sm btn-default">
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

            <form action="{{ url('careers/'.$career->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name"> Nombre de la Carrera</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $career->name) }}" required>
                </div>
                <button type="submit" class="btn btn-primary">
                    Guardar
                </button>
            </form>
        </div>
    </div>
@endsection
