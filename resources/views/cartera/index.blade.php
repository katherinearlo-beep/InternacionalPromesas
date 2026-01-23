@extends('layout')

@section('content')
    <div style="max-width:1100px; margin:auto;">

        <h1 style="color:#6a1b9a; margin-bottom:20px;">
            📊 Cartera por Categoría
        </h1>

        {{-- FILTROS --}}
        <form method="GET"
              style="display:flex; gap:12px; margin-bottom:25px; flex-wrap:wrap;">

            {{-- CATEGORIA --}}
            <div>
                <label>Categoría</label>
                <select name="categoria" class="form-input" required>
                    <option value="">Seleccione</option>
                    @foreach($categorias as $cat)
                        <option value="{{ $cat }}"
                            {{ request('categoria') == $cat ? 'selected' : '' }}>
                            {{ $cat }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- MES --}}
            <div>
                <label>Mes actual</label>
                <select name="mes" class="form-input" required>
                    <option value="">Seleccione</option>
                    @foreach([
                        'Enero','Febrero','Marzo','Abril','Mayo','Junio',
                        'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'
                    ] as $mes)
                        <option value="{{ $mes }}"
                            {{ request('mes') == $mes ? 'selected' : '' }}>
                            {{ $mes }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- AÑO --}}
            <div>
                <label>Año</label>
                <input type="number"
                       name="anio"
                       value="{{ request('anio', date('Y')) }}"
                       class="form-input">
            </div>

            <div style="align-self:end;">
                <button class="btn-purple">
                    🔍 Ver Cartera
                </button>
            </div>
        </form>

        {{-- SOLO SI YA HAY CATEGORIA --}}
        @if($categoria)

            <div style="background:white; padding:25px; border-radius:10px;
            box-shadow:0 2px 10px rgba(0,0,0,.08); overflow-x:auto;">

                <table width="100%" cellpadding="10" style="border-collapse:collapse; min-width:900px;">
                    <thead>
                    <tr style="background:#f3e5f5;">
                        <th>Estudiante</th>
                        @foreach($mesesReporte as $mes)
                            <th>{{ $mes }}</th>
                        @endforeach
                        <th>Total</th>
                        <th>Mora</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($reporte as $fila)
                        <tr style="border-bottom:1px solid #ddd;">
                            <td>{{ $fila['estudiante'] }}</td>

                            @foreach($mesesReporte as $mes)
                                <td style="text-align:right;">
                                    @if($fila['meses'][$mes])
                                        $ {{ number_format($fila['meses'][$mes], 0, ',', '.') }}
                                    @else
                                        <span style="color:#c62828;">—</span>
                                    @endif
                                </td>
                            @endforeach

                            <td style="font-weight:bold; text-align:right;">
                                $ {{ number_format($fila['total'], 0, ',', '.') }}
                            </td>

                            <td style="color:#c62828;">
                                {{ $fila['meses_mora'] }} meses
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        @endif

    </div>
@endsection
