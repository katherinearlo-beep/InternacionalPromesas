@extends('layout')

@section('content')
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h1 style="color: #4a148c;">📊 Asientos Contables</h1>

        <a href="{{ route('contabilidad.create') }}"
           style="background: #6a1b9a; color: white; padding: 10px 20px; text-decoration: none;
                  border-radius: 6px; font-weight: bold;">
            ➕ Nuevo Asiento Contable
        </a>
    </div>

    @if(session('success'))
        <div style="background: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
            {{ session('success') }}
        </div>
    @endif

    @if($entries->isEmpty())
        <div style="text-align: center; color: #555; margin-top: 40px;">
            No hay asientos contables registrados.
        </div>
    @else
        <table width="100%" cellpadding="8" cellspacing="0"
               style="border-collapse: collapse; width: 100%; background: white; border-radius: 8px; overflow: hidden;">
            <thead style="background-color: #6a1b9a; color: white;">
            <tr>
                <th style="padding: 10px;">#</th>
                <th style="padding: 10px;">Tipo</th>
                <th style="padding: 10px;">Documento</th>
                <th style="padding: 10px;">Número</th>
                <th style="padding: 10px;">Fecha</th>
                <th style="padding: 10px; text-align: right;">Débito</th>
                <th style="padding: 10px; text-align: right;">Crédito</th>
                <th style="padding: 10px;">Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($entries as $entry)
                <tr style="border-bottom: 1px solid #ddd;">
                    <td style="text-align: center;">{{ $entry->id }}</td>
                    <td style="text-align: center;">{{ $entry->tipo }}</td>
                    <td style="text-align: center;">{{ $entry->documento ?? '-' }}</td>
                    <td style="text-align: center;">{{ $entry->numero }}</td>
                    <td style="text-align: center;">{{ \Carbon\Carbon::parse($entry->fecha)->format('d/m/Y') }}</td>
                    <td style="text-align: right;">${{ number_format($entry->total_debito, 2) }}</td>
                    <td style="text-align: right;">${{ number_format($entry->total_credito, 2) }}</td>
                    <td style="text-align: center;">
                        <a href="{{ route('contabilidad.show', $entry->id) }}"
                           style="background: #2196f3; color: white; padding: 5px 10px;
                                  text-decoration: none; border-radius: 4px; font-size: 13px;">
                            👁️ Ver
                        </a>
                        <a href="{{ route('contabilidad.edit', $entry->id) }}"
                           style="background: #ff9800; color: white; padding: 5px 10px;
                                  text-decoration: none; border-radius: 4px; font-size: 13px;">
                            ✏️ Editar
                        </a>
                        <form action="{{ route('contabilidad.destroy', $entry->id) }}"
                              method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    onclick="return confirm('¿Seguro que deseas eliminar este asiento?')"
                                    style="background: #e53935; color: white; padding: 5px 10px;
                                           border: none; border-radius: 4px; cursor: pointer; font-size: 13px;">
                                🗑️ Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
@endsection
