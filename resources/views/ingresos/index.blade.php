@extends('layout')

@section('content')
    <div style="max-width: 1200px; margin:auto;">

        {{-- ENCABEZADO --}}
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:25px;">
            <h1 style="color:#6a1b9a;">📊 Ingresos</h1>

            <a href="{{ route('ingresos.create') }}"
               style="background:#5e35b1; color:white; padding:10px 16px;
                  border-radius:6px; text-decoration:none; font-weight:bold;">
                ➕ Registrar Ingreso
            </a>
        </div>

        {{-- TABLA --}}
        <div style="background:white; padding:20px; border-radius:8px;
                box-shadow:0 2px 8px rgba(0,0,0,.1);">

            <table width="100%" cellpadding="10" cellspacing="0" style="border-collapse:collapse;">
                <thead>
                <tr style="background:#f3e5f5; text-align:left;">
                    <th>Fecha</th>
                    <th>Estudiante</th>
                    <th>Concepto</th>
                    <th>Mes</th>
                    <th>Medio de pago</th>
                    <th style="text-align:right;">Valor</th>
                    <th style="text-align:center;">Recibo</th>
                    <th style="text-align:center;">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @forelse($ingresos as $ingreso)
                    <tr style="border-bottom:1px solid #eee;">
                        <td>{{ \Carbon\Carbon::parse($ingreso->fecha)->format('d/m/Y') }}</td>

                        <td>
                            {{ $ingreso->estudiante->nombre_completo }}
                        </td>

                        <td>{{ $ingreso->concepto }}</td>

                        <td>
                            {{ $ingreso->mes_correspondiente ?? '-' }}
                        </td>

                        <td>{{ $ingreso->medio_pago }}</td>

                        <td style="text-align:right; font-weight:bold;">
                            $ {{ number_format($ingreso->valor, 0, ',', '.') }}
                        </td>
                        <td style="text-align:center; white-space:nowrap;">

                            {{-- Editar --}}
                            <a href="{{ route('ingresos.edit', $ingreso->id) }}"
                               style="background:#1976d2; color:white; padding:6px 10px;
              border-radius:4px; text-decoration:none; font-size:13px;
              margin-right:6px;">
                                ✏️
                            </a>

                            {{-- Eliminar --}}
                            <form action="{{ route('ingresos.destroy', $ingreso->id) }}"
                                  method="POST"
                                  style="display:inline;"
                                  onsubmit="return confirm('¿Seguro que deseas eliminar este ingreso?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        style="background:#d32f2f; color:white; padding:6px 10px;
                                   border:none; border-radius:4px; cursor:pointer;
                                   font-size:13px;">
                                    🗑️
                                </button>
                            </form>

                        </td>
                        <td style="text-align:center;">
                            @if($ingreso->recibo)
                                <a href="{{ route('recibos.show', $ingreso->recibo->id) }}"
                                   style="background:#2e7d32; color:white; padding:6px 10px;
                  border-radius:4px; text-decoration:none; font-size:13px;">
                                    🧾 Ver
                                </a>
                            @else
                                <span style="color:#999; font-size:12px;">—</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align:center; padding:20px; color:#777;">
                            No hay ingresos registrados
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>

        </div>
        {{-- PAGINACIÓN --}}
        <div style="margin-top:25px; display:flex; justify-content:center;">
            {{ $ingresos->onEachSide(1)->links() }}
        </div>

    </div>
@endsection
