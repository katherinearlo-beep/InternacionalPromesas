<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ficha del Estudiante</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #000;
        }

        h2 {
            text-align: center;
            margin-bottom: 5px;
        }

        h4 {
            background: #eee;
            padding: 6px;
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 6px;
        }

        td {
            padding: 4px;
        }

        .label {
            font-weight: bold;
            width: 35%;
        }
    </style>
</head>
<body>

<table width="100%" style="margin-bottom: 15px;">
    <tr>
        <td width="20%" style="text-align: left;">
            <img src="{{ public_path('images/escudo.png') }}"
                 style="width: 90px;">
        </td>

        <td width="80%" style="text-align: center;">
            <h2 style="margin: 0;">INTERNACIONAL PROMESAS</h2>
            <p style="margin: 5px 0 0 0;">Ficha del Estudiante</p>
        </td>
    </tr>
</table>

<hr>

@if($estudiante->foto)
    <table align="center" style="margin-bottom:20px;">
        <tr>
            <td style="
            width:150px;
            height:150px;
            border-radius:75px;
            overflow:hidden;
            text-align:center;
            vertical-align:middle;
        ">
                <img src="{{ public_path('storage/'.$estudiante->foto) }}"
                     style="width:100px; height:auto;">
            </td>
        </tr>
    </table>
@endif

<h4>Datos del Estudiante</h4>
<table>
    <tr><td class="label">Documento:</td><td>{{ $estudiante->documento }}</td></tr>
    <tr><td class="label">Nombre:</td><td>{{ $estudiante->nombre_completo }}</td></tr>
    <tr><td class="label">Teléfono:</td><td>{{ $estudiante->telefono ?? '-' }}</td></tr>
    <tr><td class="label">Fecha nacimiento:</td><td>{{ $estudiante->fecha_nacimiento }}</td></tr>
    <tr><td class="label">Ciudad:</td><td>{{ $estudiante->ciudad_nacimiento }}</td></tr>
    <tr><td class="label">Departamento:</td><td>{{ $estudiante->departamento_nacimiento }}</td></tr>
    <tr><td class="label">Fecha ingreso:</td><td>{{ $estudiante->fecha_ingreso }}</td></tr>
    <tr><td class="label">Sexo:</td><td>{{ $estudiante->sexo }}</td></tr>
    <tr><td class="label">Edad:</td><td>{{ $estudiante->edad }}</td></tr>
    <tr><td class="label">Peso:</td><td>{{ $estudiante->peso }}</td></tr>
    <tr><td class="label">Altura:</td><td>{{ $estudiante->altura }}</td></tr>
    <tr><td class="label">Talla de uniforme:</td><td>{{ $estudiante->talla_uniforme }}</td></tr>
    <tr><td class="label">Categoria:</td><td>{{ $estudiante->categoria }}</td></tr>
    <tr><td class="label">Modalidad de Contrato:</td><td>{{ $estudiante->modalidad_contrato }}</td></tr>
    <tr><td class="label">Sede:</td><td>{{ $estudiante->sede }}</td></tr>
    <tr><td class="label">Precio Mensualidad:</td><td>{{ $estudiante->precio_mensualidad }}</td></tr>
    <tr><td class="label">Club de procedencia:</td><td>{{ $estudiante->nombre_otro_club ?? 'Ninguno' }}</td></tr>
</table>

<h4>Datos del Padre</h4>
<table>
    <tr><td class="label">Nombre:</td><td>{{ $estudiante->nombre_padre ?? '-' }}</td></tr>
    <tr><td class="label">Documento:</td><td>{{ $estudiante->documento_padre ?? '-' }}</td></tr>
    <tr><td class="label">Teléfono:</td><td>{{ $estudiante->telefono_padre ?? '-' }}</td></tr>
    <tr><td class="label">Correo:</td><td>{{ $estudiante->correo_padre ?? '-' }}</td></tr>
    <tr><td class="label">Direccion:</td><td>{{ $estudiante->direccion_padre ?? '-' }}</td></tr>
    <tr><td class="label">Departamento:</td><td>{{ $estudiante->departamento_padre ?? '-' }}</td></tr>
    <tr><td class="label">Ciudad:</td><td>{{ $estudiante->ciudad_padre ?? '-' }}</td></tr>
</table>

<h4>Datos de la Madre</h4>
<table>
    <tr><td class="label">Nombre:</td><td>{{ $estudiante->nombre_madre ?? '-' }}</td></tr>
    <tr><td class="label">Documento:</td><td>{{ $estudiante->documento_madre ?? '-' }}</td></tr>
    <tr><td class="label">Teléfono:</td><td>{{ $estudiante->telefono_madre ?? '-' }}</td></tr>
    <tr><td class="label">Correo:</td><td>{{ $estudiante->correo_madre ?? '-' }}</td></tr>
    <tr><td class="label">Direccion:</td><td>{{ $estudiante->direccion_madre ?? '-' }}</td></tr>
    <tr><td class="label">Departamento:</td><td>{{ $estudiante->departamento_madre ?? '-' }}</td></tr>
    <tr><td class="label">Ciudad:</td><td>{{ $estudiante->ciudad_madre ?? '-' }}</td></tr>
</table>

<h4>Información médica</h4>
<table>
    <tr><td class="label">Sistema de salud::</td><td>{{ $estudiante->sistema_salud ?? '-' }}</td></tr>
    <tr><td class="label">Nombre EPS:</td><td>{{ $estudiante->nombre_eps ?? '-' }}</td></tr>
    <tr><td class="label">Medicina prepagada:</td><td>{{ $estudiante->entidad_medicina_prepagada ?? 'No tiene' }}</td></tr>
    <tr><td class="label">Contacto en caso de emergencia:</td><td>{{ $estudiante->contacto_emergencia ?? '-' }}</td></tr>
</table>

<br><br>

<p>______________________________</p>
<p>Firma responsable</p>

</body>
</html>
