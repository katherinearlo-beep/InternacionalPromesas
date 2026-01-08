@extends('layout')

@section('content')
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h1 style="color: #4a148c;">⚽ Estudiantes</h1>

        <a href="{{ route('estudiantes.create') }}"
           style="background: #6a1b9a; color: white; padding: 10px 20px; text-decoration: none;
                  border-radius: 6px; font-weight: bold;">
            ➕ Nuevo Estudiante
        </a>
    </div>

    @if(session('success'))
        <div style="background: #d4edda; color: #155724; padding: 10px;
                    border-radius: 5px; margin-bottom: 15px;">
            {{ session('success') }}
        </div>
    @endif

    @if($estudiantes->isEmpty())
        <div style="text-align: center; color: #555; margin-top: 40px;">
            No hay estudiantes registrados.
        </div>
    @else
        <table width="100%" cellpadding="8" cellspacing="0"
               style="border-collapse: collapse; width: 100%; background: white;
                      border-radius: 8px; overflow: hidden;">
            <thead style="background-color: #6a1b9a; color: white;">
            <tr>
                <th style="padding: 10px;">Documento</th>
                <th style="padding: 10px;">Nombre</th>
                <th style="padding: 10px;">Teléfono</th>
                <th style="padding: 10px;">Fecha Ingreso</th>
                <th style="padding: 10px;">Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($estudiantes as $estudiante)
                <tr style="border-bottom: 1px solid #ddd;">
                    <td style="text-align: center;">{{ $estudiante->documento }}</td>
                    <td>{{ $estudiante->nombre_completo }}</td>
                    <td style="text-align: center;">
                        {{ $estudiante->telefono ?? '-' }}
                    </td>
                    <td style="text-align: center;">
                        {{ \Carbon\Carbon::parse($estudiante->fecha_ingreso)->format('d/m/Y') }}
                    </td>
                    <td style="text-align: center;">
                        <a href="{{ route('estudiantes.show', $estudiante->id) }}"
                           style="background: #2196f3; color: white; padding: 5px 10px;
                                  text-decoration: none; border-radius: 4px; font-size: 13px;">
                            👁️ Ver
                        </a>

                        <a href="{{ route('estudiantes.edit', $estudiante->id) }}"
                           style="background: #ff9800; color: white; padding: 5px 10px;
                                  text-decoration: none; border-radius: 4px; font-size: 13px;">
                            ✏️ Editar
                        </a>

                        <form action="{{ route('estudiantes.destroy', $estudiante->id) }}"
                              method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    onclick="return confirm('¿Seguro que deseas eliminar este estudiante?')"
                                    style="background: #e53935; color: white; padding: 5px 10px;
                                           border: none; border-radius: 4px; cursor: pointer; font-size: 13px;">
                                🗑️ Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div style="margin-top: 20px; display: flex; justify-content: center;">
            {{ $estudiantes->links() }}
        </div>
    @endif
@endsection
