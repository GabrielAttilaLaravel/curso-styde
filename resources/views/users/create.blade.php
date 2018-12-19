@extends('layout')

@section('title', "Crear usuario")

@section('content')
    <h1>Crear usuario</h1>

    <form method="POST" action="{{ url('usuarios/crear') }}">
        {!! csrf_field() !!}
        <button type="submit">crear usuario</button>
    </form>

    <p>
        <a href="{{ route('users.index') }}">Regresar</a>
    </p>
@endsection