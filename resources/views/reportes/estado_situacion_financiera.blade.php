@extends('layout')

@section('content')
    <h1>📘 Estado de Situación Financiera</h1>
    <p><strong>Fecha de generación:</strong> {{ $fecha->format('d/m/Y H:i') }}</p>

    <!-- Botones de acción -->
    <div style="text-align: center; margin-bottom: 20px;">
        <a href="{{ route('reportes.situacion') }}" class="btn">⬅️ Volver</a>
        <a href="{{ route('reportes.estadoSituacionFinancieraPrint') }}" target="_blank" class="btn" style="background:#6a1b9a; color:white;">🖨️ Imprimir</a>
    </div>

    <div style="display: flex; gap: 40px;">
        <!-- Activos -->
        <div style="flex: 1;">
            <h2 style="color: #2e7d32;">Activos</h2>
            <table width="100%" border="1" cellpadding="6" cellspacing="0" style="border-collapse: collapse;">
                <thead style="background: #e8f5e9;">
                <tr>
                    <th>Cuenta</th>
                    <th>Nombre</th>
                    <th style="text-align:right;">Saldo</th>
                </tr>
                </thead>
                <tbody>
                @forelse($activos as $a)
                    <tr>
                        <td>{{ $a->cuenta }}</td>
                        <td>{{ $a->nombre_cuenta }}</td>
                        <td style="text-align: right;">{{ number_format($a->total_debito - $a->total_credito, 2) }}</td>
                    </tr>
                @empty
                    <tr><td colspan="3" style="text-align:center;">No hay activos registrados</td></tr>
                @endforelse
                <tr style="font-weight:bold;">
                    <td colspan="2" style="text-align:right;">Total Activos</td>
                    <td style="text-align:right;">{{ number_format($totalActivos, 2) }}</td>
                </tr>
                </tbody>
            </table>
        </div>

        <!-- Pasivos y Patrimonio -->
        <div style="flex: 1;">
            <h2 style="color: #1565c0;">Pasivos</h2>
            <table width="100%" border="1" cellpadding="6" cellspacing="0" style="border-collapse: collapse;">
                <thead style="background: #e3f2fd;">
                <tr>
                    <th>Cuenta</th>
                    <th>Nombre</th>
                    <th style="text-align:right;">Saldo</th>
                </tr>
                </thead>
                <tbody>
                @forelse($pasivos as $p)
                    <tr>
                        <td>{{ $p->cuenta }}</td>
                        <td>{{ $p->nombre_cuenta }}</td>
                        <td style="text-align:right;">{{ number_format($p->total_credito - $p->total_debito, 2) }}</td>
                    </tr>
                @empty
                    <tr><td colspan="3" style="text-align:center;">No hay pasivos registrados</td></tr>
                @endforelse
                <tr style="font-weight:bold;">
                    <td colspan="2" style="text-align:right;">Total Pasivos</td>
                    <td style="text-align:right;">{{ number_format($totalPasivos, 2) }}</td>
                </tr>
                </tbody>
            </table>

            <h2 style="margin-top:20px; color: #6a1b9a;">Patrimonio</h2>
            <table width="100%" border="1" cellpadding="6" cellspacing="0" style="border-collapse: collapse;">
                <thead style="background: #f3e5f5;">
                <tr>
                    <th>Cuenta</th>
                    <th>Nombre</th>
                    <th style="text-align:right;">Saldo</th>
                </tr>
                </thead>
                <tbody>
                @forelse($patrimonio as $pt)
                    <tr>
                        <td>{{ $pt->cuenta }}</td>
                        <td>{{ $pt->nombre_cuenta }}</td>
                        <td style="text-align:right;">{{ number_format($pt->total_credito - $pt->total_debito, 2) }}</td>
                    </tr>
                @empty
                    <tr><td colspan="3" style="text-align:center;">No hay patrimonio registrado</td></tr>
                @endforelse
                <tr style="font-weight:bold;">
                    <td colspan="2" style="text-align:right;">Total Patrimonio</td>
                    <td style="text-align:right;">{{ number_format($totalPatrimonio, 2) }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <hr style="margin-top:30px;">
    <h3 style="text-align:center;">
        💰 Total Activos = {{ number_format($totalActivos, 2) }} <br>
        ⚖️ Total Pasivo + Patrimonio = {{ number_format($totalPasivos + $totalPatrimonio, 2) }}
    </h3>

    <p style="text-align:center; color:#666;">
        Reporte generado automáticamente por el sistema el {{ now()->format('d/m/Y H:i:s') }}
    </p>
@endsection
