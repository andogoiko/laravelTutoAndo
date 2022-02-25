@extends('layout')

@section('title', "Mostrar usuarios")

@section('content')
    
    <h1>{{ $title }}</h1>
    <ul>
        @forelse ($users as $user)
            <li>
                {{ $user->name }}, ({{ $user->email }})
                <!-- <a href="{{-- url("/usuarios/{$user->id}") --}}"> ver detalles</a> habria que quitar el -- para que funcione -->
                <!--<a href="{{-- action('userController@show', ['id' => $user->id]) --}}"> ver detalles</a>-->
                <a href="{{ route('users.show', ['id' => $user->id]) }}"> ver detalles</a>
            </li>
        @empty
            <li>no hay usuarios registrados</li>
        @endforelse
    </ul>
@endsection

@section('sidebar')
@parent
<h2>Barra lateral personalida</h2>
@endsection