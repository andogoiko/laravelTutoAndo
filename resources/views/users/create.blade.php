@extends('layout')

@section('title', "Crear usuario")

@section('content')

    <div class="card">
        <h4 class="card-header">Crear usuario</h4>
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    <p>por favor corrige los errores de debajo:</p>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        
            <form method="POST" action="{{ url('usuarios') }}">
                {{-- proteger de inyección de datos con este token --}}
                {{ csrf_field() }}
            
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
                
                </div>
            
                <div class="form-group">
                <label for="email">Correo electrónico</label>
                <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}">
                
                </div>
            
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" class="form-control" name="password" id="password">
                
                </div>
            
                <button type="submit" class="btn btn-primary">Crear usuario</button>
            
                <a href="{{ route('users.index') }}" class="btn btn-link">Regresar al listado de usuarios</a>
            
            </form>
        </div>
    </div>

@endsection