@extends('layout')

@section('title', "Crear usuario")

@section('content')
    <div class="card">
        <h4 class="card-header">Crear usuario</h4>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <h5>Por favor corrige los errores debajo:</h5>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ url('usuarios') }}">
                {!! csrf_field() !!}
                <div class="form-group">
                    <label for="name">Nombre:</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Gabriel Moreno" value="{{ old('name') }}">
                </div>
                <div class="form-group">
                    <label for="email">Correo electrónico:</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="gabriel@example.com" value="{{ old('email') }}">
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="Mayor a 6 caracteres">
                </div>

                <button type="submit" class="btn btn-primary">crear usuario</button>
                <a href="{{ route('users.index') }}" class="btn btn-link">Regresar</a>
            </form>
        </div>
    </div>
@endsection