@extends('layout')

@section('title', "Crear usuario")

@section('content')
    <h1>Editar usuario</h1>

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
        <label for="name">Nombre</label>
        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}">

        <br>
        <label for="email">Correo electrónico</label>
        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}">
        <br>
        <label for="password">Contraseña</label>
        <input type="password" name="password" id="password">
        <br>
        <button type="submit">Actualizar usuario</button>
    </form>
    <p>
        <a href="{{ route('users.index') }}">Regresar al listado de usuarios</a>
    </p>
@endsection