@extends('layout')

@section('content')
    <div style="max-width: 900px; margin: auto;">

        <h1 style="color:#6a1b9a; margin-bottom:20px;">💰 Registrar Ingreso</h1>

        <form action="{{ route('ingresos.store') }}" method="POST">
            @csrf

            <div style="display:grid; grid-template-columns: repeat(4, 1fr); gap:20px;">

                {{-- ESTUDIANTE --}}
                <div style="grid-column: span 4;">
                    <label>Estudiante *</label>
                    <select name="estudiante_id" class="form-input" required>
                        <option value="">Seleccione un estudiante</option>
                        @foreach($estudiantes as $estudiante)
                            <option value="{{ $estudiante->id }}">
                                {{ $estudiante->nombre_completo }} - {{ $estudiante->documento }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- CONCEPTO --}}
                <div style="grid-column: span 2;">
                    <label>Concepto *</label>
                    <select name="concepto" id="concepto" class="form-input" required>
                        <option value="">Seleccione un concepto</option>
                        <option value="Matricula">Matrícula</option>
                        <option value="Mensualidad">Mensualidad</option>
                        <option value="Póliza">Póliza</option>
                        <option value="Uniforme">Uniforme</option>
                        <option value="Boletas">Boletas</option>
                        <option value="Torneos">Torneos</option>
                        <option value="Fisioterapia">Fisioterapia</option>
                        <option value="Morral">Morral</option>
                        <option value="Uniforme de Presentacion">Uniforme de Presentacion</option>
                        <option value="Paz y Salvo">Paz y Salvo</option>
                    </select>
                </div>

                {{-- MES CORRESPONDIENTE --}}
                <div style="grid-column: span 2; display:none;" id="mes-container">
                    <label>Mes correspondiente *</label>
                    <select name="mes_correspondiente" class="form-input">
                        <option value="">Seleccione el mes</option>
                        @foreach([
                            'Enero','Febrero','Marzo','Abril','Mayo','Junio',
                            'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'
                        ] as $mes)
                            <option value="{{ $mes }}">{{ $mes }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- VALOR --}}
                <div style="grid-column: span 2;">
                    <label>Valor *</label>
                    <input type="number" name="valor" class="form-input" required min="0" step="0.01">
                </div>

                {{-- MEDIO DE PAGO --}}
                <div style="grid-column: span 2;">
                    <label>Medio de pago *</label>
                    <select name="medio_pago" class="form-input" required>
                        <option value="">Seleccione</option>
                        <option value="Transferencia">Transferencia</option>
                        <option value="Cuenta Anterior 2025">Cuenta Anterior 2025</option>
                        <option value="Efectivo">Efectivo</option>
                    </select>
                </div>

                {{-- FECHA --}}
                <div style="grid-column: span 2;">
                    <label>Fecha *</label>
                    <input type="date" name="fecha" class="form-input" required value="{{ date('Y-m-d') }}">
                </div>

            </div>

            {{-- BOTONES --}}
            <div style="margin-top:25px; display:flex; gap:10px;">
                <button type="submit" class="btn-purple" style="padding:10px 20px; border-radius:6px;">
                    💾 Guardar Ingreso
                </button>

                <a href="{{ route('ingresos.index') }}"
                   style="background:#9e9e9e; color:white; padding:10px 20px;
                      text-decoration:none; border-radius:6px;">
                    ⬅️ Volver
                </a>
            </div>

        </form>
    </div>

    {{-- JS --}}
    <script>
        document.getElementById('concepto').addEventListener('change', function () {
            const mesContainer = document.getElementById('mes-container');

            if (this.value === 'Mensualidad') {
                mesContainer.style.display = 'block';
            } else {
                mesContainer.style.display = 'none';
                mesContainer.querySelector('select').value = '';
            }
        });
    </script>
@endsection
