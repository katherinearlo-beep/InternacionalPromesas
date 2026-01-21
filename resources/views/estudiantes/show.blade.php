@extends('layout')

@section('content')
    <div style="max-width: 900px; margin: auto;">

        <h1 style="color: #4a148c; margin-bottom: 20px;">📋 Ficha del Estudiante</h1>

        {{-- DATOS DEL ESTUDIANTE --}}
        <div style="background: white; padding: 20px; border-radius: 8px;
                    box-shadow: 0 2px 8px rgba(0,0,0,.1); margin-bottom: 25px;">

            <h3 style="border-bottom: 2px solid #eee; padding-bottom: 8px;">👤 Datos del Estudiante</h3>

            <table width="100%" cellspacing="0" cellpadding="10"
                   style="border-collapse: separate; border-spacing: 0 10px;">
                @if($estudiante->foto)
                    <div style="text-align:center; margin-bottom:20px;">
                        <div style="
                        width:150px;
                        height:150px;
                        border-radius:75px;
                        overflow:hidden;
                        display:inline-flex;
                        align-items:center;
                        justify-content:center;
                    ">
                            <img src="{{ asset('storage/'.$estudiante->foto) }}"
                                 style="width:100px; height:auto;">
                        </div>
                    </div>
                @endif
                <tr>
                    <td><strong>Documento:</strong></td>
                    <td>{{ $estudiante->documento }}</td>
                </tr>
                <tr>
                    <td><strong>Nombre completo:</strong></td>
                    <td>{{ $estudiante->nombre_completo }}</td>
                </tr>
                <tr>
                    <td><strong>Teléfono:</strong></td>
                    <td>{{ $estudiante->telefono ?? '-' }}</td>
                </tr>
                <tr>
                    <td><strong>Fecha de nacimiento:</strong></td>
                    <td>{{ \Carbon\Carbon::parse($estudiante->fecha_nacimiento)->format('d/m/Y') }}</td>
                </tr>
                <tr>
                    <td><strong>Ciudad de nacimiento:</strong></td>
                    <td>{{ $estudiante->ciudad_nacimiento }}</td>
                </tr>
                <tr>
                    <td><strong>Departamento:</strong></td>
                    <td>{{ $estudiante->departamento_nacimiento }}</td>
                </tr>
                <tr>
                    <td><strong>Fecha de ingreso:</strong></td>
                    <td>{{ \Carbon\Carbon::parse($estudiante->fecha_ingreso)->format('d/m/Y') }}</td>
                </tr>
            </table>
        </div>

        <div style="background: white; padding: 20px; border-radius: 8px;
                    box-shadow: 0 2px 8px rgba(0,0,0,.1); margin-bottom: 25px;">

            <h3 style="border-bottom: 2px solid #eee; padding-bottom: 8px;">Informacion Deportiva</h3>

            <table width="100%" cellspacing="0" cellpadding="10"
                   style="border-collapse: separate; border-spacing: 0 10px;">
                <tr>
                    <td><strong>Sexo:</strong></td>
                    <td>{{ $estudiante->sexo }}</td>
                </tr>
                <tr>
                    <td><strong>Edad:</strong></td>
                    <td>{{ $estudiante->edad }}</td>
                </tr>
                <tr>
                    <td><strong>Talla de uniforme:</strong></td>
                    <td>{{ $estudiante->talla_uniforme ?? '-' }}</td>
                </tr>
                <tr>
                    <td><strong>Categoria:</strong></td>
                    <td>{{ $estudiante->categoria ?? '-' }}</td>
                </tr>
                <tr>
                    <td><strong>Modalidad de contrato:</strong></td>
                    <td>{{ $estudiante->modalidad_contrato ?? '-'}}</td>
                </tr>
                <tr>
                    <td><strong>Sede:</strong></td>
                    <td>{{ $estudiante->sede ?? '-'}}</td>
                </tr>
                <tr>
                    <td><strong>Mensualidad:</strong></td>
                    <td>{{ $estudiante->precio_mensualidad ?? '-'}}</td>
                </tr>
                <tr>
                    <td><strong>Club de Procedencia:</strong></td>
                    <td>{{ $estudiante->nombre_otro_club ?? 'Ninguno'}}</td>
                </tr>
            </table>
        </div>

        {{-- DATOS DEL PADRE --}}
        <div style="background: white; padding: 20px; border-radius: 8px;
                    box-shadow: 0 2px 8px rgba(0,0,0,.1); margin-bottom: 25px;">

            <h3 style="border-bottom: 2px solid #eee; padding-bottom: 8px;">👨 Datos del Padre</h3>

            <table width="100%" cellspacing="0" cellpadding="10"
                   style="border-collapse: separate; border-spacing: 0 10px;">
                <tr>
                    <td><strong>Nombre:</strong></td>
                    <td>{{ $estudiante->nombre_padre ?? '-' }}</td>
                </tr>
                <tr>
                    <td><strong>Documento:</strong></td>
                    <td>{{ $estudiante->documento_padre ?? '-' }}</td>
                </tr>
                <tr>
                    <td><strong>Teléfono:</strong></td>
                    <td>{{ $estudiante->telefono_padre ?? '-' }}</td>
                </tr>
                <tr>
                    <td><strong>Correo:</strong></td>
                    <td>{{ $estudiante->correo_padre ?? '-' }}</td>
                </tr>
                <tr>
                    <td><strong>Direccion:</strong></td>
                    <td>{{ $estudiante->direccion_padre ?? '-' }}</td>
                </tr>
                <tr>
                    <td><strong>Departamento:</strong></td>
                    <td>{{ $estudiante->departamento_padre ?? '-' }}</td>
                </tr>
                <tr>
                    <td><strong>Ciudad:</strong></td>
                    <td>{{ $estudiante->ciudad_padre ?? '-' }}</td>
                </tr>
            </table>
        </div>

        {{-- DATOS DE LA MADRE --}}
        <div style="background: white; padding: 20px; border-radius: 8px;
                    box-shadow: 0 2px 8px rgba(0,0,0,.1); margin-bottom: 25px;">

            <h3 style="border-bottom: 2px solid #eee; padding-bottom: 8px;">👩 Datos de la Madre</h3>

            <table width="100%" cellspacing="0" cellpadding="10"
                   style="border-collapse: separate; border-spacing: 0 10px;">
                <tr>
                    <td><strong>Nombre:</strong></td>
                    <td>{{ $estudiante->nombre_madre ?? '-' }}</td>
                </tr>
                <tr>
                    <td><strong>Documento:</strong></td>
                    <td>{{ $estudiante->documento_madre ?? '-' }}</td>
                </tr>
                <tr>
                    <td><strong>Teléfono:</strong></td>
                    <td>{{ $estudiante->telefono_madre ?? '-' }}</td>
                </tr>
                <tr>
                    <td><strong>Correo:</strong></td>
                    <td>{{ $estudiante->correo_madre ?? '-' }}</td>
                </tr>
                <tr>
                    <td><strong>Direccion:</strong></td>
                    <td>{{ $estudiante->direccion_madre ?? '-' }}</td>
                </tr>
                <tr>
                    <td><strong>Departamento:</strong></td>
                    <td>{{ $estudiante->departamento_madre ?? '-' }}</td>
                </tr>
                <tr>
                    <td><strong>Ciudad:</strong></td>
                    <td>{{ $estudiante->ciudad_madre ?? '-' }}</td>
                </tr>
            </table>
        </div>

        {{-- DATOS MEDICOS --}}
        <div style="background: white; padding: 20px; border-radius: 8px;
                    box-shadow: 0 2px 8px rgba(0,0,0,.1); margin-bottom: 25px;">

            <h3 style="border-bottom: 2px solid #eee; padding-bottom: 8px;">Información médica</h3>

            <table width="100%" cellspacing="0" cellpadding="10"
                   style="border-collapse: separate; border-spacing: 0 10px;">
                <tr>
                    <td><strong>Sistema de salud:</strong></td>
                    <td>{{ $estudiante->sistema_salud ?? '-' }}</td>
                </tr>
                <tr>
                    <td><strong>Nombre EPS:</strong></td>
                    <td>{{ $estudiante->nombre_eps ?? '-' }}</td>
                </tr>
                <tr>
                    <td><strong>Medicina prepagada:</strong></td>
                    <td>{{ $estudiante->entidad_medicina_prepagada ?? 'No tiene' }}</td>
                </tr>
                <tr>
                    <td><strong>Contacto en caso de emergencia:</strong></td>
                    <td>{{ $estudiante->contacto_emergencia ?? '-' }}</td>
                </tr>
            </table>
        </div>

        {{-- BOTONES --}}
        <div style="display: flex; gap: 10px;">
            <a href="{{ route('estudiantes.edit', $estudiante->id) }}"
               style="background: #ff9800; color: white; padding: 10px 15px;
                      text-decoration: none; border-radius: 6px;">
                ✏️ Editar
            </a>

            <a href="{{ route('estudiantes.index') }}"
               style="background: #9e9e9e; color: white; padding: 10px 15px;
                      text-decoration: none; border-radius: 6px;">
                ⬅️ Volver
            </a>

            <a href="{{ route('estudiantes.pdf', $estudiante->id) }}"
               target="_blank"
               style="background: #4caf50; color: white; padding: 10px 15px;
                    text-decoration: none; border-radius: 6px;">
                🖨️ Imprimir PDF
            </a>
        </div>

    </div>
@endsection
