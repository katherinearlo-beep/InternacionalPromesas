@extends('layout')

@section('content')
    <div style="max-width:900px; margin:auto;">

        <h1 style="color:#6a1b9a; margin-bottom:20px;">
            📊 Estado de Resultados
        </h1>

        {{-- FILTROS --}}
        <form method="GET"
              style="display:flex; gap:12px; margin-bottom:25px; flex-wrap:wrap;">

            <select name="mes" class="form-input">
                <option value="">Todos los meses</option>
                @foreach([
                    1=>'Enero',2=>'Febrero',3=>'Marzo',4=>'Abril',
                    5=>'Mayo',6=>'Junio',7=>'Julio',8=>'Agosto',
                    9=>'Septiembre',10=>'Octubre',11=>'Noviembre',12=>'Diciembre'
                ] as $num => $m)
                    <option value="{{ $num }}"
                        {{ request('mes') == $num ? 'selected' : '' }}>
                        {{ $m }}
                    </option>
                @endforeach
            </select>

            <input type="number"
                   name="anio"
                   placeholder="Año"
                   value="{{ request('anio') }}"
                   class="form-input">

            <button class="btn-purple">
                🔍 Ver
            </button>
        </form>

        {{-- TARJETA --}}
        <div style="background:white; padding:25px; border-radius:10px;
            box-shadow:0 2px 10px rgba(0,0,0,.08);">

            {{-- INGRESOS --}}
            <h3 style="color:#2e7d32; margin-bottom:10px;">Ingresos</h3>

            <table width="100%" cellpadding="10" style="border-collapse:collapse;">
                @foreach($ingresos as $i)
                    <tr>
                        <td>{{ $i->concepto }}</td>
                        <td style="text-align:right;">
                            $ {{ number_format($i->total, 0, ',', '.') }}
                        </td>
                    </tr>
                @endforeach

                <tr style="border-top:2px solid #2e7d32;">
                    <td><strong>Total Ingresos</strong></td>
                    <td style="text-align:right; font-weight:bold; color:#2e7d32;">
                        $ {{ number_format($totalIngresos, 0, ',', '.') }}
                    </td>
                </tr>
            </table>

            <br>

            {{-- GASTOS --}}
            <h3 style="color:#c62828; margin-bottom:10px;">Gastos</h3>

            <table width="100%" cellpadding="10" style="border-collapse:collapse;">
                @foreach($gastos as $g)
                    <tr>
                        <td>{{ $g->concepto }}</td>
                        <td style="text-align:right;">
                            $ {{ number_format($g->total, 0, ',', '.') }}
                        </td>
                    </tr>
                @endforeach

                <tr style="border-top:2px solid #c62828;">
                    <td><strong>Total Gastos</strong></td>
                    <td style="text-align:right; font-weight:bold; color:#c62828;">
                        $ {{ number_format($totalGastos, 0, ',', '.') }}
                    </td>
                </tr>
            </table>

            <br>

            {{-- RESULTADO --}}
            <table width="100%" cellpadding="12" style="border-collapse:collapse;">
                <tr style="border-top:3px solid #444;">
                    <td><strong>Resultado del Periodo</strong></td>
                    <td style="
                text-align:right;
                font-size:22px;
                font-weight:bold;
                color: {{ $resultado >= 0 ? '#2e7d32' : '#c62828' }};
            ">
                        $ {{ number_format($resultado, 0, ',', '.') }}
                    </td>
                </tr>
            </table>

            @if($resultado < 0)
                <p style="margin-top:10px; color:#c62828;">
                    ⚠️ El periodo presenta pérdida
                </p>
            @endif

        </div>
    </div>
@endsection

