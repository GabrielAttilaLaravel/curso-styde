@extends('layout')

@section('title', "Crear usuario")

@section('content')
    <h1>Crear usuario</h1>

    <form method="POST" action="{{ url('usuarios') }}">
        {!! csrf_field() !!}

        <label for="name">Nombre:</label>
        <input type="text" name="name" id="name" placeholder="Gabriel Moreno">
        <br>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" placeholder="gabriel@example.com">
        <br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" placeholder="Mayor a 6 caracteres">
        <br>
        <button type="submit">crear usuario</button>
    </form>

    <p>
        <a href="{{ route('users.index') }}">Regresar</a>
    </p>
@endsection