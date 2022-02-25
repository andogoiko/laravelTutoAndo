@extends('layout')

@section('title', "Mostrar usuarios")

@section('content')
    

    <ul>
        @forelse ($users as $user)
            <li>{{ $user->name }}</li>
        @empty
            <li>no hay usuarios registrados</li>
        @endforelse
    </ul>
@endsection

@section('sidebar')
@parent
<h2>Barra lateral personalida</h2>
@endsection