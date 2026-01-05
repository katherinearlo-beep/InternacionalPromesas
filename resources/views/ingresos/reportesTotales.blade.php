@extends('layout')

@section('content')
    <div style="max-width:1100px; margin:auto;">

        <h1 style="color:#6a1b9a; margin-bottom:20px;">
            💰 Reportes Totales
        </h1>

        {{-- FILTRO --}}
        <form method="GET"
              style="display:grid; grid-template-columns: repeat(12, 1fr);
             gap:15px; margin-bottom:30px; align-items:end;">

            {{-- Estudiante --}}
            <div style="grid-column: span 5;">
                <label>Estudiante</label>
                <select name="estudiante_id" class="form-input">
                    <option value="">Todos</option>
                    @foreach($estudiantes as $e)
                        <option value="{{ $e->id }}"
                            {{ $estudianteId == $e->id ? 'selected' : '' }}>
                            {{ $e->nombre_completo }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Mes --}}
            <div style="grid-column: span 3;">
                <label>Mes</label>
                <select name="mes" class="form-input">
                    @foreach([
                        1=>'Enero',2=>'Febrero',3=>'Marzo',4=>'Abril',
                        5=>'Mayo',6=>'Junio',7=>'Julio',8=>'Agosto',
                        9=>'Septiembre',10=>'Octubre',11=>'Noviembre',12=>'Diciembre'
                    ] as $num => $m)
                        <option value="{{ $num }}" {{ $mes == $num ? 'selected' : '' }}>
                            {{ $m }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Año --}}
            <div style="grid-column: span 2;">
                <label>Año</label>
                <input type="number" name="anio" value="{{ $anio }}" class="form-input">
            </div>

            {{-- Botón --}}
            <div style="grid-column: span 2;">
                <button class="btn-purple" style="width:100%; padding:10px;">
                    🔍 Ver
                </button>
            </div>
        </form>

        {{-- TOTAL GENERAL --}}
        <div style="background:#ede7f6; border-left:6px solid #5e35b1;
                padding:18px; border-radius:8px; margin-bottom:30px;">
            <h3 style="margin:0;">Total del mes</h3>
            <p style="font-size:28px; font-weight:bold; color:#2e7d32;">
                $ {{ number_format($totalGeneral, 0, ',', '.') }}
            </p>
        </div>

        {{-- POR CONCEPTO --}}
        <h3 style="color:#6a1b9a;">📌 Totales por concepto</h3>

        <table width="100%" cellpadding="10" cellspacing="0"
               style="border-collapse:collapse; margin-bottom:30px;">
            <thead style="background:#f3e5f5;">
            <tr>
                <th>Concepto</th>
                <th style="text-align:right;">Total</th>
            </tr>
            </thead>
            <tbody>
            @foreach($totalesPorConcepto as $c)
                <tr style="border-bottom:1px solid #eee;">
                    <td>{{ $c->concepto }}</td>
                    <td style="text-align:right; font-weight:bold;">
                        $ {{ number_format($c->total, 0, ',', '.') }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{-- POR MEDIO DE PAGO --}}
        <h3 style="color:#6a1b9a;">💳 Totales por medio de pago</h3>

        <table width="100%" cellpadding="10" cellspacing="0"
               style="border-collapse:collapse;">
            <thead style="background:#f3e5f5;">
            <tr>
                <th>Medio de pago</th>
                <th style="text-align:right;">Total</th>
            </tr>
            </thead>
            <tbody>
            @foreach($totalesPorMedioPago as $m)
                <tr style="border-bottom:1px solid #eee;">
                    <td>{{ $m->medio_pago }}</td>
                    <td style="text-align:right; font-weight:bold;">
                        $ {{ number_format($m->total, 0, ',', '.') }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
@endsection
