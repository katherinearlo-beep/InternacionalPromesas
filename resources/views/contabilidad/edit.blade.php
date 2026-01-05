@extends('layout')

@section('content')
    <h1>✏️ Editar Asiento Contable</h1>

    @if($errors->any())
        <div style="background: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('contabilidad.update', $entry->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
            <div>
                <label>Tipo:</label>
                <input type="text" name="tipo" value="{{ old('tipo', $entry->tipo) }}" required style="width: 100%;">
            </div>
            <div>
                <label>Documento:</label>
                <input type="text" name="documento" value="{{ old('documento', $entry->documento) }}" style="width: 100%;">
            </div>
            <div>
                <label>Número:</label>
                <input type="text" name="numero" value="{{ old('numero', $entry->numero) }}" required style="width: 100%;">
            </div>
            <div>
                <label>Fecha:</label>
                <input type="date" name="fecha" value="{{ old('fecha', $entry->fecha) }}" required style="width: 100%;">
            </div>
        </div>

        <div style="margin-top: 10px;">
            <label>Observaciones:</label>
            <textarea name="observaciones" style="width: 100%;" rows="3">{{ old('observaciones', $entry->observaciones) }}</textarea>
        </div>

        <h3 style="margin-top: 25px;">🧾 Movimientos</h3>
        <table border="1" width="100%" cellpadding="6" cellspacing="0" style="margin-top: 10px; border-collapse: collapse;">
            <thead style="background-color: #6a1b9a; color: white;">
            <tr>
                <th>Cuenta</th>
                <th>Nombre Cuenta</th>
                <th>Débito</th>
                <th>Crédito</th>
                <th>Observaciones</th>
            </tr>
            </thead>
            <tbody id="movimientos">
            @foreach(old('movimientos', $entry->movements->toArray()) as $i => $mov)
                <tr>
                    <td><input type="text" name="movimientos[{{ $i }}][cuenta]" value="{{ $mov['cuenta'] }}" required></td>
                    <td><input type="text" name="movimientos[{{ $i }}][nombre_cuenta]" value="{{ $mov['nombre_cuenta'] }}"></td>
                    <td><input type="number" step="0.01" name="movimientos[{{ $i }}][debito]" value="{{ $mov['debito'] }}"></td>
                    <td><input type="number" step="0.01" name="movimientos[{{ $i }}][credito]" value="{{ $mov['credito'] }}"></td>
                    <td><input type="text" name="movimientos[{{ $i }}][observaciones]" value="{{ $mov['observaciones'] }}"></td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <button type="submit"
                style="margin-top: 20px; background: #6a1b9a; color: white; padding: 10px 20px; border: none; border-radius: 6px; cursor: pointer;">
            💾 Guardar Cambios
        </button>

        <a href="{{ route('contabilidad.index') }}"
           style="margin-left: 10px; background: #6c757d; color: white; padding: 10px 20px; border-radius: 6px; text-decoration: none;">
            ↩️ Cancelar
        </a>
    </form>
@endsection
