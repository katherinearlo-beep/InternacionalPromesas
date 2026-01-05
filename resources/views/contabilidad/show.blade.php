@extends('layout')

@section('content')
    <h1>👁️ Ver Asiento Contable</h1>

    <a href="{{ route('contabilidad.index') }}"
       style="background: #6a1b9a; color: white; padding: 8px 15px; border-radius: 5px; text-decoration: none;">
        ⬅️ Volver al listado
    </a>

    <div style="margin-top: 20px; border: 1px solid #ddd; padding: 15px; border-radius: 6px;">
        <p><strong>Tipo:</strong> {{ $entry->tipo }}</p>
        <p><strong>Documento:</strong> {{ $entry->documento }}</p>
        <p><strong>Número:</strong> {{ $entry->numero }}</p>
        <p><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($entry->fecha)->format('d/m/Y') }}</p>
        <p><strong>Observaciones:</strong> {{ $entry->observaciones ?: 'Ninguna' }}</p>
        <p><strong>Total Débito:</strong> ${{ number_format($entry->total_debito, 2) }}</p>
        <p><strong>Total Crédito:</strong> ${{ number_format($entry->total_credito, 2) }}</p>
    </div>

    <h3 style="margin-top: 30px;">🧾 Movimientos</h3>
    <table border="1" width="100%" cellpadding="8" cellspacing="0" style="margin-top: 10px; border-collapse: collapse;">
        <thead style="background: #6a1b9a; color: white;">
        <tr>
            <th>Cuenta</th>
            <th>Nombre Cuenta</th>
            <th>Débito</th>
            <th>Crédito</th>
            <th>Observaciones</th>
        </tr>
        </thead>
        <tbody>
        @forelse($entry->movements as $mov)
            <tr>
                <td>{{ $mov->cuenta }}</td>
                <td>{{ $mov->nombre_cuenta }}</td>
                <td style="text-align: right;">${{ number_format($mov->debito, 2) }}</td>
                <td style="text-align: right;">${{ number_format($mov->credito, 2) }}</td>
                <td>{{ $mov->observaciones }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="5" style="text-align: center;">No hay movimientos registrados.</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <div style="margin-top: 25px;">
        <a href="{{ route('contabilidad.edit', $entry->id) }}"
           style="background: #ffc107; color: black; padding: 8px 15px; border-radius: 5px; text-decoration: none;">
            ✏️ Editar
        </a>

        <form action="{{ route('contabilidad.destroy', $entry->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit"
                    onclick="return confirm('¿Seguro que deseas eliminar este asiento?')"
                    style="background: #dc3545; color: white; padding: 8px 15px; border: none; border-radius: 5px; cursor: pointer;">
                🗑️ Eliminar
            </button>
        </form>
        <a href="{{ route('contabilidad.print', $entry->id) }}"
           style="background: #17a2b8; color: white; padding: 8px 15px; border-radius: 5px; text-decoration: none;">
            🖨️ Imprimir
        </a>
    </div>
@endsection
