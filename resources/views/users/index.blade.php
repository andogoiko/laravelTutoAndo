@extends('layout')

@section('title', "Mostrar usuarios")

@section('content')
    <div class="d-flex justify-content-between align-items-end mb-2">
        <h1 class="pb-1">{{ $title }}</h1>

        <p>
            <a href="{{ route('users.create') }}" class="btn btn-primary">Nuevo usuario</a>
        </p>
    </div>
    

    @if ($users->isNotEmpty())

    <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nombre</th>
      <th scope="col">Correo</th>
      <th scope="col">Acciones</th>
    </tr>
  </thead>
  <tbody>
      @foreach ($users as $user)
        <tr>
          <th scope="row">{{ $user->id }}</th>
          <td>{{ $user->name }}</td>
          <td>{{ $user->email }}</td>
          <td>
            <!-- <a href="{{-- url("/usuarios/{$user->id}") --}}"> ver detalles</a> habria que quitar el -- para que funcione -->
                <!--<a href="{{-- action('userController@show', ['id' => $user->id]) --}}"> ver detalles</a>-->
                <a href="{{ route('users.show', $user) }}" class="btn btn-link"><span class="oi oi-eye"></span></a>
                <a href="{{ route('users.edit', $user) }}" class="btn btn-link"><span class="oi oi-pencil"></span></a>
                <form action="{{ route('users.destroy', $user) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                <button type="submit" class="btn btn-link"><span class="oi oi-trash"></span></button>
                </form>
          </td>
        </tr>
      @endforeach
  </tbody>
</table>

@else

    <p>no hay usuarios registrados.</p>

@endif

@endsection

@section('sidebar')
@parent
<h2>Barra lateral personalida</h2>
@endsection