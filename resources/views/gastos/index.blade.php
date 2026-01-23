@extends('layout')

@section('content')
    <div style="max-width:1100px; margin:auto;">

        <h1 style="color:#6a1b9a; margin-bottom:20px;">📋 Listado de Gastos y Egresos</h1>

        {{-- FILTROS --}}
        <form method="GET"
              style="margin-bottom:20px; display:flex; gap:20px; flex-wrap:wrap; align-items:flex-end;">

            {{-- FECHA INICIAL --}}
            <div>
                <label>Fecha inicial</label>
                <input type="date"
                       name="desde"
                       class="form-input"
                       value="{{ request('desde') }}">
            </div>

            {{-- FECHA FINAL --}}
            <div>
                <label>Fecha final</label>
                <input type="date"
                       name="hasta"
                       class="form-input"
                       value="{{ request('hasta') }}">
            </div>

            {{-- SEDE --}}
            <div>
                <label>Sede</label>
                <select name="sede" class="form-input">
                    <option value="">Todas las sedes</option>
                    <option value="envigado" @selected(request('sede')=='envigado')>Envigado</option>
                    <option value="itagui" @selected(request('sede')=='itagui')>Itagüí</option>
                </select>
            </div>

            {{-- BOTÓN FILTRAR --}}
            <div>
                <button class="btn-purple"
                        style="padding:10px 18px; border-radius:6px; margin-top:22px;">
                    🔍 Filtrar
                </button>
            </div>

            {{-- NUEVO GASTO --}}
            <div>
                <a href="{{ route('gastos.create') }}"
                   class="btn-purple"
                   style="padding:10px 18px; border-radius:6px; text-decoration:none; margin-top:22px; display:inline-block;">
                    ➕ Nuevo Gasto
                </a>
            </div>

        </form>

        {{-- TABLA --}}
        <table width="100%" cellpadding="8" cellspacing="0" style="border-collapse:collapse;">
            <thead style="background:#6a1b9a; color:white;">
            <tr>
                <th>Fecha</th>
                <th>NIT</th>
                <th>Nombre</th>
                <th>Concepto</th>
                <th>Sede</th>
                <th style="text-align:right;">Valor</th>
                <th style="text-align:center;">Acciones</th>
            </tr>
            </thead>
            <tbody>
            @forelse($gastos as $gasto)
                <tr style="border-bottom:1px solid #ddd;">
                    <td>{{ $gasto->fecha->format('Y-m-d') }}</td>
                    <td>{{ $gasto->nit }}</td>
                    <td>{{ $gasto->nombre }}</td>
                    <td>{{ $gasto->concepto }}</td>
                    <td style="text-transform:capitalize;">{{ $gasto->sede }}</td>
                    <td style="text-align:right;">
                        $ {{ number_format($gasto->valor, 2, ',', '.') }}
                    </td>
                    <td style="text-align:center; white-space:nowrap;">

                        {{-- EDITAR --}}
                        <a href="{{ route('gastos.edit', $gasto) }}"
                           style="color:#1565c0; margin-right:8px; text-decoration:none;">
                            ✏️
                        </a>

                        {{-- ELIMINAR --}}
                        <form action="{{ route('gastos.destroy', $gasto) }}"
                              method="POST"
                              style="display:inline;"
                              onsubmit="return confirm('¿Seguro que deseas eliminar este gasto?');">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    style="border:none; background:none; cursor:pointer; color:#c62828;">
                                🗑️
                            </button>
                        </form>

                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align:center; padding:20px;">
                        No hay gastos registrados
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>

        {{-- PAGINACIÓN --}}
        <div style="margin-top: 20px;">
            {{ $gastos->links('pagination.simple') }}
        </div>

    </div>
@endsection

