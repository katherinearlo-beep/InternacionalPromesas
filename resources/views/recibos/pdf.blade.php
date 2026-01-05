<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Recibo {{ $recibo->numero }}</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 13px;
            color: #000;
        }

        .header {
            width: 100%;
            margin-bottom: 20px;
            border-bottom: 2px solid #6a1b9a;
            padding-bottom: 10px;
        }

        .header-table {
            width: 100%;
        }

        .header-table td {
            vertical-align: middle;
        }

        .logo {
            width: 90px;
        }

        .title {
            text-align: center;
        }

        .title h2 {
            margin: 0;
            color: #6a1b9a;
        }

        .title p {
            margin: 2px 0;
            font-size: 12px;
        }

        .content p {
            margin: 6px 0;
        }

        .total {
            margin-top: 15px;
            font-size: 16px;
            font-weight: bold;
        }

        .firma {
            margin-top: 60px;
            text-align: center;
        }

        .firma hr {
            width: 200px;
        }
    </style>
</head>
<body>

{{-- ENCABEZADO --}}
<div class="header">
    <table class="header-table">
        <tr>
            <td width="20%">
                <img src="{{ public_path('images/escudo.png') }}" class="logo">
            </td>

            <td width="60%" class="title">
                <h2>INTERNACIONAL PROMESAS</h2>
                <p><strong>RECIBO DE PAGO</strong></p>
            </td>

            <td width="20%" style="text-align:right;">
                <p><strong>No.</strong> {{ $recibo->numero }}</p>
                <p>{{ \Carbon\Carbon::parse($recibo->fecha)->format('d/m/Y') }}</p>
            </td>
        </tr>
    </table>
</div>

{{-- CONTENIDO --}}
<div class="content">
    <p><strong>Estudiante:</strong> {{ $recibo->ingreso->estudiante->nombre_completo }}</p>
    <p><strong>Concepto:</strong> {{ $recibo->ingreso->concepto }}</p>

    @if($recibo->ingreso->mes_correspondiente)
        <p><strong>Mes correspondiente:</strong> {{ $recibo->ingreso->mes_correspondiente }}</p>
    @endif

    <p><strong>Medio de pago:</strong> {{ $recibo->ingreso->medio_pago }}</p>

    <div class="total">
        Total pagado:
        $ {{ number_format($recibo->ingreso->valor, 0, ',', '.') }}
    </div>
</div>

{{-- FIRMA --}}
<div class="firma">
    <hr>
    <p>Firma autorizada</p>
</div>

</body>
</html>
