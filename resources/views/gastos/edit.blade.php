@extends('layout')

@section('content')
    <div style="max-width: 900px; margin:auto;">

        <h1 style="color:#6a1b9a; margin-bottom:20px;">✏️ Editar Gasto</h1>

        <form action="{{ route('gastos.update', $gasto) }}" method="POST">
            @csrf
            @method('PUT')

            <div style="display:grid; grid-template-columns: repeat(4, 1fr); gap:20px;">

                <div style="grid-column: span 2;">
                    <label>Fecha *</label>
                    <input type="date" name="fecha" class="form-input"
                           value="{{ $gasto->fecha->format('Y-m-d') }}" required>
                </div>

                <div style="grid-column: span 2;">
                    <label>Sede *</label>
                    <select name="sede" class="form-input" required>
                        <option value="envigado" @selected($gasto->sede=='envigado')>Envigado</option>
                        <option value="itagui" @selected($gasto->sede=='itagui')>Itagüí</option>
                    </select>
                </div>

                <div style="grid-column: span 2;">
                    <label>NIT *</label>
                    <input type="text" name="nit" class="form-input"
                           value="{{ $gasto->nit }}" required>
                </div>

                <div style="grid-column: span 2;">
                    <label>Nombre *</label>
                    <input type="text" name="nombre" class="form-input"
                           value="{{ $gasto->nombre }}" required>
                </div>

                <div style="grid-column: span 4;">
                    <label>Concepto *</label>
                    <input type="text" name="concepto" class="form-input"
                           value="{{ $gasto->concepto }}" required>
                </div>

                <div style="grid-column: span 2;">
                    <label>Valor *</label>
                    <input type="number" name="valor" class="form-input"
                           value="{{ $gasto->valor }}" step="0.01" required>
                </div>

            </div>

            <div style="margin-top:25px; display:flex; gap:10px;">
                <button class="btn-purple">
                    💾 Actualizar
                </button>

                <a href="{{ route('gastos.index') }}"
                   style="background:#9e9e9e; color:white; padding:10px 20px;
               text-decoration:none; border-radius:6px;">
                    ⬅️ Volver
                </a>
            </div>

        </form>
    </div>
@endsection
