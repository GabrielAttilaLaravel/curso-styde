@extends('layout')

@section('title', "Usuario: {$user->id}")

@section('content')
    <div class="card">
        <h4 class="card-header">Usuario #{{ $user->id }}</h4>
        <div class="card-body">
            <p><b>Nombre del usuario:</b> {{ $user->name }}</p>
            <p><b>Correo electrónico:</b> {{ $user->email }}</p>
            <a href="{{ route('users.index') }}" class="btn btn-link">Regresar</a>
        </div>
    </div>
@endsection