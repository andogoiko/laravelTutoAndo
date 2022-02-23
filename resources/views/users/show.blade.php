@extends('layout')

@section('title', "Usuario #{$id}")

@section('content')
    <p>Mostrando detalle del usuario: {{ $id }}</p>
@endsection