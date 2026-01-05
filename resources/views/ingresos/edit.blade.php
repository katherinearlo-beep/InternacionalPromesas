@extends('layout')

@section('content')
    <div style="max-width: 800px; margin:auto;">

        {{-- ENCABEZADO --}}
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:25px;">
            <h1 style="color:#6a1b9a;">✏️ Editar Ingreso</h1>

            <a href="{{ route('ingresos.index') }}"
               style="background:#e0e0e0; color:#333; padding:10px 16px;
                      border-radius:6px; text-decoration:none; font-weight:bold;">
                ⬅ Volver
            </a>
        </div>

        <form action="{{ route('ingresos.update', $ingreso->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div style="background:white; padding:25px; border-radius:10px;
                        box-shadow:0 3px 8px rgba(0,0,0,.1);">

                <div style="display:grid; grid-template-columns:repeat(12,1fr); gap:18px;">

                    {{-- FECHA --}}
                    <div style="grid-column: span 4;">
                        <label>Fecha *</label>
                        <input type="date" name="fecha" class="form-input"
                               value="{{ old('fecha', $ingreso->fecha) }}" required>
                    </div>

                    {{-- ESTUDIANTE --}}
                    <div style="grid-column: span 8;">
                        <label>Estudiante *</label>
                        <select name="estudiante_id" class="form-input" required>
                            <option value="">Seleccione</option>
                            @foreach($estudiantes as $e)
                                <option value="{{ $e->id }}"
                                    {{ old('estudiante_id', $ingreso->estudiante_id) == $e->id ? 'selected' : '' }}>
                                    {{ $e->nombre_completo }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- CONCEPTO --}}
                    <div style="grid-column: span 4;">
                        <label>Concepto *</label>
                        <select name="concepto" id="concepto" class="form-input" required>
                            @foreach(['Matricula','Mensualidad','Póliza','Uniforme','Boletas','Torneos'] as $c)
                                <option value="{{ $c }}"
                                    {{ old('concepto', $ingreso->concepto) == $c ? 'selected' : '' }}>
                                    {{ $c }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- MES --}}
                    <div id="campo_mes" style="grid-column: span 4;">
                        <label>Mes correspondiente</label>
                        <select name="mes_correspondiente" class="form-input">
                            <option value="">Seleccione</option>
                            @foreach([
                                1=>'Enero',2=>'Febrero',3=>'Marzo',4=>'Abril',
                                5=>'Mayo',6=>'Junio',7=>'Julio',8=>'Agosto',
                                9=>'Septiembre',10=>'Octubre',11=>'Noviembre',12=>'Diciembre'
                            ] as $num => $mes)
                                <option value="{{ $num }}"
                                    {{ old('mes_correspondiente', $ingreso->mes_correspondiente) == $num ? 'selected' : '' }}>
                                    {{ $mes }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- MEDIO DE PAGO --}}
                    <div style="grid-column: span 4;">
                        <label>Medio de pago *</label>
                        <select name="medio_pago" class="form-input" required>
                            @foreach(['Transferencia','Efectivo'] as $medio)
                                <option value="{{ $medio }}"
                                    {{ old('medio_pago', $ingreso->medio_pago) == $medio ? 'selected' : '' }}>
                                    {{ $medio }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- VALOR --}}
                    <div style="grid-column: span 4;">
                        <label>Valor *</label>
                        <input type="number" name="valor" class="form-input"
                               value="{{ old('valor', $ingreso->valor) }}" required>
                    </div>

                </div>
            </div>

            {{-- BOTÓN --}}
            <div style="text-align:right; margin-top:25px;">
                <button type="submit"
                        style="background:#6a1b9a; color:white; padding:12px 28px;
                               border:none; border-radius:8px; font-weight:bold; cursor:pointer;">
                    💾 Actualizar Ingreso
                </button>
            </div>

        </form>
    </div>

    {{-- JS --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const concepto = document.getElementById('concepto');
            const campoMes = document.getElementById('campo_mes');

            function toggleMes() {
                campoMes.style.display = concepto.value === 'Mensualidad' ? 'block' : 'none';
            }

            toggleMes();
            concepto.addEventListener('change', toggleMes);
        });
    </script>
@endsection
