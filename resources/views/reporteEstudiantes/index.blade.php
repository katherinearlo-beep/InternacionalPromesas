@extends('layout')

@section('content')
    <div style="max-width:1100px; margin:auto;">

        <h1 style="color:#6a1b9a; margin-bottom:20px;">📊 Reporte por estudiante</h1>

        {{-- FILTRO --}}
        <form method="GET"
              style="display:grid; grid-template-columns: repeat(12, 1fr);
                 gap:15px; margin-bottom:25px; align-items:end;">

            {{-- Estudiante --}}
            <div style="grid-column: span 5;">
                <label>Estudiante</label>
                <select name="estudiante_id" class="form-input" required>
                    <option value="">Seleccione</option>
                    @foreach($estudiantes as $e)
                        <option value="{{ $e->id }}"
                            {{ $estudianteId == $e->id ? 'selected' : '' }}>
                            {{ $e->nombre_completo }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Mes --}}
            <div style="grid-column: span 4;">
                <label>Mes</label>
                <select name="mes" class="form-input">
                    <option value="">Todos los meses</option>
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
            <div style="grid-column: span 1;">
                <button class="btn-purple" style="width:100%; padding:10px;">
                    🔍
                </button>
            </div>
        </form>

        @if($estudianteId)

            {{-- TOTAL --}}
            <div style="background:#ede7f6; border-left:6px solid #5e35b1;
                    padding:16px 20px; border-radius:8px; margin-bottom:25px;">
                <strong>Total del mes:</strong>
                <span style="font-size:22px; font-weight:bold; color:#2e7d32;">
                $ {{ number_format($total, 0, ',', '.') }}
            </span>
            </div>

            {{-- TABLA --}}
            <div style="background:white; padding:20px; border-radius:8px;
                    box-shadow:0 2px 8px rgba(0,0,0,.08);">

                <table width="100%" cellpadding="10" cellspacing="0"
                       style="border-collapse:collapse; table-layout:fixed;">

                    <thead style="background:#f3e5f5;">
                    <tr>
                        <th style="width:15%;">Fecha</th>
                        <th style="width:25%;">Concepto</th>
                        <th style="width:15%; text-align:center;">Mes</th>
                        <th style="width:20%;">Medio de pago</th>
                        <th style="width:15%; text-align:right;">Valor</th>
                    </tr>
                    </thead>

                    <tbody>
                    @forelse($ingresos as $i)
                        <tr style="border-bottom:1px solid #eee;">
                            <td>
                                {{ \Carbon\Carbon::parse($i->fecha)->format('d/m/Y') }}
                            </td>

                            <td>{{ $i->concepto }}</td>

                            <td style="text-align:center;">
                                {{ $i->mes_correspondiente ?? '-' }}
                            </td>

                            <td>{{ $i->medio_pago }}</td>

                            <td style="text-align:right; font-weight:bold;">
                                $ {{ number_format($i->valor, 0, ',', '.') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5"
                                style="text-align:center; padding:18px; color:#777;">
                                No hay ingresos registrados
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>

            </div>

        @endif

    </div>
@endsection
