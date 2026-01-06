@extends('layout')

@section('content')
    <h1>Listado de Usuarios</h1>

    @if(session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @endif

    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse;">
        <thead>
        <tr style="background-color: #5e35b1; color: white;">
            <th>ID</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Rol</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ optional($user->roleRelation)->name ?? 'Sin rol' }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
