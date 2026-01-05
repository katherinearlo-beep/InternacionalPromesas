<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Asiento Contable #{{ $entry->numero }}</title>
    <style>
        body {
            font-family: "Segoe UI", Arial, sans-serif;
            margin: 40px;
            color: #333;
        }
        h1, h2 {
            color: #6a1b9a;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            border: 1px solid #aaa;
            padding: 6px 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        .totales {
            text-align: right;
            font-weight: bold;
        }
        .header-info {
            margin-bottom: 20px;
        }
        .header-info p {
            margin: 4px 0;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 0.9em;
            color: #666;
        }
        @media print {
            .no-print {
                display: none;
            }
        }
        .btn {
            background: #6a1b9a;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo img {
            width: 90px;
            height: auto;
        }
    </style>
</head>
<body>
<div class="no-print" style="text-align: center; margin-bottom: 20px;">
    <a href="{{ route('contabilidad.show', $entry->id) }}" class="btn">⬅️ Volver</a>
    <button onclick="window.print()" class="btn">🖨️ Imprimir</button>
</div>

<div class="logo">
    <img src="{{ asset('images/escudo.png') }}" alt="Escudo Internacional Promesas">
</div>

<h1>Asiento Contable</h1>
<h2>#{{ $entry->numero }}</h2>

<div class="header-info">
    <p><strong>Tipo:</strong> {{ $entry->tipo }}</p>
    <p><strong>Documento:</strong> {{ $entry->documento }}</p>
    <p><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($entry->fecha)->format('d/m/Y') }}</p>
    <p><strong>Observaciones:</strong> {{ $entry->observaciones ?: 'Ninguna' }}</p>
</div>

<table>
    <thead>
    <tr>
        <th>Cuenta</th>
        <th>Nombre cuenta</th>
        <th>Débito</th>
        <th>Crédito</th>
        <th>Observaciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($entry->movements as $mov)
        <tr>
            <td>{{ $mov->cuenta }}</td>
            <td>{{ $mov->nombre_cuenta }}</td>
            <td style="text-align: right;">{{ number_format($mov->debito, 2) }}</td>
            <td style="text-align: right;">{{ number_format($mov->credito, 2) }}</td>
            <td>{{ $mov->observaciones }}</td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <td colspan="2" class="totales">Totales:</td>
        <td class="totales">${{ number_format($entry->total_debito, 2) }}</td>
        <td class="totales">${{ number_format($entry->total_credito, 2) }}</td>
        <td></td>
    </tr>
    </tfoot>
</table>

<div class="footer">
    <p>Documento generado automáticamente - {{ config('app.name', 'Sistema Contable') }}</p>
    <p>Impreso el {{ now()->format('d/m/Y') }} a las {{ now()->format('H:i:s') }}</p>
</div>
</body>
</html>
