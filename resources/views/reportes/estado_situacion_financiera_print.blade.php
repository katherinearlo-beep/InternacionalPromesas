<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Estado de Situación Financiera</title>
    <style>
        body {
            font-family: "Segoe UI", Arial, sans-serif;
            margin: 40px;
            color: #333;
            font-size: 12px; /* tamaño normal para contenido */
        }
        .header { text-align: center; margin-bottom: 20px; }
        .header img { width: 80px; margin-bottom: 10px; }
        .header h2 { margin: 2px 0; font-size: 16px; } /* título empresa */
        .header h3 { margin: 4px 0; font-size: 14px; }  /* título reporte */
        .header h4 { margin: 2px 0; font-size: 12px; }  /* nit */

        h3.section-title { font-size: 14px; margin-top:20px; margin-bottom:5px; }

        .fila {
            display:flex;
            justify-content: space-between;
            padding: 3px 0;
            font-size: 12px;
        }

        .totales {
            display:flex;
            justify-content: space-between;
            padding:6px 0;
            font-weight:bold;
            border-top:1px solid #333;
            margin-top:5px;
            font-size: 12px;
        }

        .firmas { margin-top: 80px; width: 100%; font-size: 12px; }
        .firmas td { text-align: center; padding-top: 40px; }
        .firmas .linea { border-top: 1px solid #000; width: 200px; margin: 0 auto; }

        .btn {
            background: #6a1b9a;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            font-size: 12px;
        }
        @media print { .no-print { display: none; } }

        .footer { text-align:center; margin-top:40px; color:#555; font-size:12px; }
    </style>
</head>
<body>

<!-- Botones solo visibles antes de imprimir -->
<div class="no-print" style="text-align: center; margin-bottom: 20px;">
    <a href="{{ route('reportes.situacion') }}" class="btn" style="background:#999; margin-right:10px;">⬅️ Volver</a>
    <button onclick="window.print()" class="btn">🖨️ Imprimir</button>
</div>

<div class="header">
    <img src="{{ asset('images/escudo.png') }}" alt="Escudo Internacional Promesas">
    <h2>INTERNACIONAL PROMESAS SAS</h2>
    <h4>NIT: 902.005.168 - 3</h4>
    <h3>ESTADO DE SITUACIÓN FINANCIERA</h3>
    <p><strong>al {{ \Carbon\Carbon::now()->endOfMonth()->day }} de {{ \Carbon\Carbon::now()->translatedFormat('F') }} de {{ \Carbon\Carbon::now()->year }}</strong></p>
</div>

<h3 class="section-title">Activos</h3>
<div>
    @foreach($activos as $a)
        <div class="fila">
            <div style="flex:1; text-align:left;">{{ $a->nombre_cuenta }}</div>
            <div style="flex:1; text-align:right;">{{ number_format($a->total_debito - $a->total_credito, 2) }}</div>
        </div>
    @endforeach
    <div class="totales">
        <div style="flex:1; text-align:left;">TOTAL ACTIVOS</div>
        <div style="flex:1; text-align:right;">{{ number_format($totalActivos, 2) }}</div>
    </div>
</div>

<h3 class="section-title">Pasivos</h3>
<div>
    @foreach($pasivos as $p)
        <div class="fila">
            <div style="flex:1; text-align:left;">{{ $p->nombre_cuenta }}</div>
            <div style="flex:1; text-align:right;">{{ number_format($p->total_credito - $p->total_debito, 2) }}</div>
        </div>
    @endforeach
    <div class="totales">
        <div style="flex:1; text-align:left;">TOTAL PASIVOS</div>
        <div style="flex:1; text-align:right;">{{ number_format($totalPasivos, 2) }}</div>
    </div>
</div>

<h3 class="section-title">Patrimonio</h3>
<div>
    @foreach($patrimonio as $pt)
        <div class="fila">
            <div style="flex:1; text-align:left;">{{ $pt->nombre_cuenta }}</div>
            <div style="flex:1; text-align:right;">{{ number_format($pt->total_credito - $pt->total_debito, 2) }}</div>
        </div>
    @endforeach
    <div class="totales">
        <div style="flex:1; text-align:left;">TOTAL PATRIMONIO</div>
        <div style="flex:1; text-align:right;">{{ number_format($totalPatrimonio, 2) }}</div>
    </div>
</div>

<h3 style="text-align:left; margin-top:25px; font-size:14px;">
    Total Activos = {{ number_format($totalActivos, 2) }} <br>
    Total Pasivo + Patrimonio = {{ number_format($totalPasivos + $totalPatrimonio, 2) }}
</h3>

<table class="firmas">
    <tr>
        <td>
            <div class="linea"></div>
            <p>Elaborado por</p>
        </td>
        <td>
            <div class="linea"></div>
            <p>Representante Legal</p>
        </td>
    </tr>
</table>

<div class="footer">
    <p>Generado automáticamente por {{ config('app.name', 'Sistema Contable') }}</p>
    <p>{{ $fecha->setTimezone('America/Bogota')->format('d/m/Y H:i:s') }}</p>
</div>

</body>
</html>
