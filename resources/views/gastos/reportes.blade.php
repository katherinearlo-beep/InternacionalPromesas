@extends('layout')

@section('content')
    <div style="max-width:1000px; margin:auto;">

        <h1 style="color:#6a1b9a; margin-bottom:20px;">📊 Reporte de Gastos</h1>

        {{-- FILTROS --}}
        <form method="GET" style="display:flex; gap:10px; margin-bottom:20px;">
            <select name="sede" class="form-input">
                <option value="">Todas las sedes</option>
                <option value="envigado" @selected(request('sede')=='envigado')>Envigado</option>
                <option value="itagui" @selected(request('sede')=='itagui')>Itagüí</option>
            </select>

            <select name="mes" class="form-input">
                <option value="">Mes</option>
                @for($i=1;$i<=12;$i++)
                    <option value="{{ $i }}" @selected(request('mes')==$i)>
                        {{ date('F', mktime(0,0,0,$i,1)) }}
                    </option>
                @endfor
            </select>

            <input type="number" name="anio" class="form-input"
                   placeholder="Año" value="{{ request('anio', date('Y')) }}">

            <button class="btn-purple" style="padding:8px 16px; border-radius:6px;">
                📊 Ver Reporte
            </button>
        </form>

        {{-- TOTAL --}}
        <div style="background:#f3e5f5; padding:15px; border-radius:8px; margin-bottom:20px;">
            <strong>Total de gastos:</strong>
            <span style="font-size:20px; color:#6a1b9a;">
            $ {{ number_format($total, 2, ',', '.') }}
        </span>
        </div>

    </div>
@endsection

