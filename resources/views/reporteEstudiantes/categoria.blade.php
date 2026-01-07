@extends('layout')

@section('content')
    <div style="margin-bottom: 25px;">
        <h1 style="color: #4a148c;">Reporte por Categoría</h1>

        {{-- Formulario para seleccionar categoría --}}
        <form method="GET" action="{{ route('reporteEstudiantes.categoria') }}">
            <div style="margin-bottom: 20px;">
                <label for="categoria">Selecciona la Categoría:</label>
                <select name="categoria" id="categoria" class="form-input" required>
                    <option value="">Seleccione...</option>
                    <option value="Estimulación">Estimulación</option>
                    <option value="SUB 6">SUB 6</option>
                    <option value="SUB 7">SUB 7</option>
                    <option value="SUB 8">SUB 8</option>
                    <option value="SUB 9">SUB 9</option>
                    <option value="SUB 10">SUB 10</option>
                    <option value="SUB 11 Rendimiento">SUB 11 Rendimiento</option>
                    <option value="SUB 11 Academia">SUB 11 Academia</option>
                    <option value="SUB 12 Rendimiento">SUB 12 Rendimiento</option>
                    <option value="SUB 12 Academia">SUB 12 Academia</option>
                    <option value="SUB 13 Rendimiento">SUB 13 Rendimiento</option>
                    <option value="SUB 13 Academia">SUB 13 Academia</option>
                    <option value="SUB 14 Rendimiento">SUB 14 Rendimiento</option>
                    <option value="SUB 14 Academia">SUB 14 Academia</option>
                    <option value="SUB 15 Academia">SUB 15 Academia</option>
                    <option value="SUB 15 Rendimiento">SUB 15 Rendimiento</option>
                    <option value="SUB 16 Rendimiento">SUB 16 Rendimiento</option>
                    <option value="SUB 17 Rendimiento">SUB 17 Rendimiento</option>
                    <option value="Administrativo">Administrativo</option>
                </select>
                <button type="submit" style="background: #6a1b9a; color: white; padding: 8px 20px; border: none; border-radius: 6px; cursor: pointer; margin-top: 10px;">
                    Buscar Estudiantes
                </button>
            </div>
        </form>

        @if(isset($estudiantes) && $estudiantes->count() > 0)
            <div style="background: white; padding: 25px; border-radius: 10px; box-shadow: 0 3px 8px rgba(0,0,0,0.1);">
                <h3 style="color: #6a1b9a; margin-bottom: 20px;">Estudiantes en la categoría seleccionada</h3>
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                    <tr>
                        <th style="padding: 10px; border: 1px solid #ddd;">Documento</th>
                        <th style="padding: 10px; border: 1px solid #ddd;">Nombre Completo</th>
                        <th style="padding: 10px; border: 1px solid #ddd;">Categoría</th>
                        <th style="padding: 10px; border: 1px solid #ddd;">Ver Ficha</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($estudiantes as $estudiante)
                        <tr>
                            <td style="padding: 10px; border: 1px solid #ddd;">{{ $estudiante->documento }}</td>
                            <td style="padding: 10px; border: 1px solid #ddd;">{{ $estudiante->nombre_completo }}</td>
                            <td style="padding: 10px; border: 1px solid #ddd;">{{ $estudiante->categoria }}</td>
                            <td style="padding: 10px; border: 1px solid #ddd;">
                                <a href="{{ route('estudiantes.show', $estudiante->id) }}" style="color: #6a1b9a; text-decoration: none;">Ver Ficha</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p>No se encontraron estudiantes para esta categoría.</p>
        @endif
    </div>
@endsection
