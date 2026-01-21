@extends('layout')

@section('content')
    <div style="max-width: 900px; margin:auto;">

        <h1 style="color:#6a1b9a; margin-bottom:20px;">➖ Registrar Gasto / Egreso</h1>

        <form action="{{ route('gastos.store') }}" method="POST">
            @csrf

            <div style="display:grid; grid-template-columns: repeat(4, 1fr); gap:20px;">

                {{-- FECHA --}}
                <div style="grid-column: span 2;">
                    <label>Fecha del gasto *</label>
                    <input type="date" name="fecha" class="form-input" required value="{{ date('Y-m-d') }}">
                </div>

                {{-- SEDE --}}
                <div style="grid-column: span 2;">
                    <label>Sede *</label>
                    <select name="sede" class="form-input" required>
                        <option value="">Seleccione</option>
                        <option value="envigado">Envigado</option>
                        <option value="itagui">Itagüí</option>
                    </select>
                </div>

                {{-- NIT --}}
                <div style="grid-column: span 2;">
                    <label>NIT *</label>
                    <input type="text" name="nit" class="form-input" required>
                </div>

                {{-- NOMBRE --}}
                <div style="grid-column: span 2;">
                    <label>Nombre *</label>
                    <input type="text" name="nombre" class="form-input" required>
                </div>

                {{-- CONCEPTO --}}
                <div style="grid-column: span 4;">
                    <label>Concepto *</label>
                    <input type="text" name="concepto" class="form-input"
                           placeholder="Ej: Compra de balones, transporte, papelería…" required>
                </div>

                {{-- VALOR --}}
                <div style="grid-column: span 2;">
                    <label>Valor *</label>
                    <input type="number" name="valor" class="form-input" required min="0" step="0.01">
                </div>

            </div>

            {{-- BOTONES --}}
            <div style="margin-top:25px; display:flex; gap:10px;">
                <button type="submit" class="btn-purple" style="padding:10px 20px; border-radius:6px;">
                    💾 Guardar Gasto
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

