@extends('layout')

@section('content')
    <div style="max-width: 900px; margin: auto;">

        <h1 style="color:#6a1b9a; margin-bottom:20px;">💰 Registrar Usuario</h1>

        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <label>Nombre:</label>
            <input type="text" name="name" required>

            <label>Email:</label>
            <input type="email" name="email" required>

            <label>Contraseña:</label>
            <input type="password" name="password" required>

            <label>Rol:</label>
            <select name="role" required>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>

            <button type="submit">Crear Usuario</button>
        </form>
    </div>
@endsection
