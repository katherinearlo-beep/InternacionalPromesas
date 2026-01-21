@extends('layout')

@section('content')

    {{-- ================= HEADER ================= --}}
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
        <h1 style="color: #4a148c;">✏️ Editar Estudiante</h1>

        <a href="{{ route('estudiantes.index') }}"
           style="background: #e0e0e0; color: #333; padding: 10px 18px;
                  text-decoration: none; border-radius: 6px; font-weight: bold;">
            ⬅ Volver
        </a>
    </div>

    {{-- ERRORES DE VALIDACIÓN --}}
    @if ($errors->any())
        <div style="background:#ffebee; color:#b71c1c; padding:15px; border-radius:8px; margin-bottom:20px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form action="{{ route('estudiantes.update', $estudiante->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- ================= DATOS DEL ESTUDIANTE ================= --}}
        <div style="background: white; padding: 25px; border-radius: 10px;
                    box-shadow: 0 3px 8px rgba(0,0,0,0.1);
                    margin-bottom: 30px;">

            <h3 style="color: #6a1b9a; margin-bottom: 20px;">
                Datos del estudiante
            </h3>

            <div style="display: grid; grid-template-columns: repeat(12, 1fr); gap: 18px;">

                <div style="grid-column: span 4;">
                    <label>Documento *</label>
                    <input type="text" name="documento" class="form-input"
                           value="{{ old('documento', $estudiante->documento) }}" required>
                </div>

                <div style="grid-column: span 8;">
                    <label>Nombre completo *</label>
                    <input type="text" name="nombre_completo" class="form-input"
                           value="{{ old('nombre_completo', $estudiante->nombre_completo) }}" required>
                </div>

                <div style="grid-column: span 4;">
                    <label>Teléfono</label>
                    <input type="text" name="telefono" class="form-input"
                           value="{{ old('telefono', $estudiante->telefono) }}">
                </div>

                <div style="grid-column: span 8;">
                    <label>Dirección</label>
                    <input type="text" name="direccion" class="form-input"
                           value="{{ old('direccion', $estudiante->direccion) }}">
                </div>

                <div style="grid-column: span 4;">
                    <label>Fecha de nacimiento *</label>
                    <input type="date" name="fecha_nacimiento" class="form-input"
                           value="{{ old('fecha_nacimiento', $estudiante->fecha_nacimiento) }}" required>
                </div>

                <div style="grid-column: span 4;">
                    <label>Ciudad de nacimiento *</label>
                    <input type="text" name="ciudad_nacimiento" class="form-input"
                           value="{{ old('ciudad_nacimiento', $estudiante->ciudad_nacimiento) }}" required>
                </div>

                <div style="grid-column: span 4;">
                    <label>Departamento *</label>
                    <input type="text" name="departamento_nacimiento" class="form-input"
                           value="{{ old('departamento_nacimiento', $estudiante->departamento_nacimiento) }}" required>
                </div>

                <div style="grid-column: span 4;">
                    <label>Fecha de ingreso *</label>
                    <input type="date" name="fecha_ingreso" class="form-input"
                           value="{{ old('fecha_ingreso', $estudiante->fecha_ingreso) }}" required>
                </div>

            </div>
        </div>

        {{-- ================= INFORMACIÓN DEPORTIVA ================= --}}
        <div style="background: white; padding: 25px; border-radius: 10px;
            box-shadow: 0 3px 8px rgba(0,0,0,0.1);
            margin-bottom: 30px;">

            <h3 style="color: #6a1b9a; margin-bottom: 20px;">
                Información deportiva
            </h3>

            <div style="display: grid; grid-template-columns: repeat(12, 1fr); gap: 18px;">

                <div style="grid-column: span 4;">
                    <label>Nueva foto (opcional)</label>
                    <input type="file" name="foto" class="form-input" accept="image/*">

                    @if($estudiante->foto)
                        <br>
                        <img src="{{ asset('storage/'.$estudiante->foto) }}"
                             style="max-width:120px; margin-top:8px;">
                    @endif
                </div>

                <div style="grid-column: span 4;">
                    <label>Sexo</label>
                    <select name="sexo" class="form-input">
                        <option value="">Seleccione</option>
                        <option value="masculino" {{ old('sexo', $estudiante->sexo) == 'masculino' ? 'selected' : '' }}>Masculino</option>
                        <option value="femenino" {{ old('sexo', $estudiante->sexo) == 'femenino' ? 'selected' : '' }}>Femenino</option>
                        <option value="sin_definir" {{ old('sexo', $estudiante->sexo) == 'sin_definir' ? 'selected' : '' }}>Sin definir</option>
                    </select>
                </div>

                <div style="grid-column: span 2;">
                    <label>Edad</label>
                    <input type="number" name="edad" class="form-input"
                           value="{{ old('edad', $estudiante->edad) }}">
                </div>

                <div style="grid-column: span 3;">
                    <label>Talla de uniforme</label>
                    <input type="text" name="talla_uniforme" class="form-input"
                           value="{{ old('talla_uniforme', $estudiante->talla_uniforme) }}">
                </div>

                <div style="grid-column: span 3;">
                    <label>Categoría</label>
                    <select name="categoria" class="form-input">
                        <option value="">Seleccione</option>
                        @foreach([
                            'Estimulación','SUB 6','SUB 7','SUB 8','SUB 9','SUB 10',
                            'SUB 11 Rendimiento','SUB 11 Academia',
                            'SUB 12 Rendimiento','SUB 12 Academia',
                            'SUB 13 Rendimiento','SUB 13 Academia',
                            'SUB 14 Rendimiento','SUB 14 Academia',
                            'SUB 15 Academia','SUB 15 Rendimiento',
                            'SUB 16 Rendimiento','SUB 17 Rendimiento','Administrativo'
                        ] as $categoria)
                            <option value="{{ $categoria }}"
                                {{ old('categoria', $estudiante->categoria) == $categoria ? 'selected' : '' }}>
                                {{ $categoria }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div style="grid-column: span 3;">
                    <label>Modalidad de contrato</label>
                    <select name="modalidad_contrato" class="form-input">
                        @foreach([
                            'mensual' => 'Mensual',
                            'becado_50' => 'Becado 50%',
                            'becado_100' => 'Becado 100%'
                        ] as $value => $label)

                            <option value="{{ $value }}"
                                {{ old('modalidad_contrato', $estudiante->modalidad_contrato) == $value ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div style="grid-column: span 3;">
                    <label>Sede</label>
                    <select name="sede" class="form-input">
                        @foreach(['Itagui','Envigado','Medellín','Administrativa'] as $sede)
                            <option value="{{ $sede }}"
                                {{ old('sede', $estudiante->sede) == $sede ? 'selected' : '' }}>
                                {{ $sede }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div style="grid-column: span 3;">
                    <label>Precio mensualidad</label>
                    <input type="number" step="0.01" name="precio_mensualidad" class="form-input"
                           value="{{ old('precio_mensualidad', $estudiante->precio_mensualidad) }}">
                </div>

            </div>
        </div>
        {{-- ================= HISTORIAL DEPORTIVO ================= --}}
        <div style="background: white; padding: 25px; border-radius: 10px;
            box-shadow: 0 3px 8px rgba(0,0,0,0.1);
            margin-bottom: 30px;">

            <h3 style="color: #6a1b9a; margin-bottom: 20px;">
                Historial deportivo
            </h3>

            <div style="display: grid; grid-template-columns: repeat(12, 1fr); gap: 18px;">

                <div style="grid-column: span 4;">
                    <label>¿Ha participado en otro club?</label>
                    <select name="otro_club" id="otro_club" class="form-input">
                        <option value="1" {{ old('otro_club', $estudiante->otro_club) == 1 ? 'selected' : '' }}>Sí</option>
                        <option value="0" {{ old('otro_club', $estudiante->otro_club) == 0 ? 'selected' : '' }}>No</option>
                    </select>
                </div>

                <div id="nombre_otro_club" style="grid-column: span 8;">
                    <label>Nombre del club</label>
                    <input type="text" name="nombre_otro_club" class="form-input"
                           value="{{ old('nombre_otro_club', $estudiante->nombre_otro_club) }}">
                </div>

            </div>
        </div>

        {{-- ================= DATOS DEL ACUDIENTE ================= --}}
        <div style="background: white; padding: 25px; border-radius: 10px;
                    box-shadow: 0 3px 8px rgba(0,0,0,0.1);
                    margin-bottom: 30px;">

            <h3 style="color: #6a1b9a; margin-bottom: 10px;">
                Padre o Madre
            </h3>

            <p style="color: #777; font-size: 14px; margin-bottom: 25px;">
                Debe registrar al menos uno de los dos.
            </p>

            {{-- ===== PADRE ===== --}}
            <div style="border: 1px solid #ddd; border-radius: 8px; padding: 20px; margin-bottom: 25px;">
                <h4 style="margin-bottom: 15px; color: #4a148c;">👨 Padre</h4>

                <div style="display: grid; grid-template-columns: repeat(12, 1fr); gap: 15px;">
                    <div style="grid-column: span 4;">
                        <label>Nombre Completo</label>
                        <input type="text" name="nombre_padre" class="form-input"
                               value="{{ old('nombre_padre', $estudiante->nombre_padre) }}">
                    </div>

                    <div style="grid-column: span 4;">
                        <label>Documento</label>
                        <input type="text" name="documento_padre" class="form-input"
                               value="{{ old('documento_padre', $estudiante->documento_padre) }}">
                    </div>

                    <div style="grid-column: span 4;">
                        <label>Teléfono</label>
                        <input type="text" name="telefono_padre" class="form-input"
                               value="{{ old('telefono_padre', $estudiante->telefono_padre) }}">
                    </div>

                    <div style="grid-column: span 4;">
                        <label>Correo</label>
                        <input type="email" name="correo_padre" class="form-input"
                               value="{{ old('correo_padre', $estudiante->correo_padre) }}">
                    </div>

                    <div style="grid-column: span 4;">
                        <label>Direccion</label>
                        <input type="text" name="direccion_padre" class="form-input"
                               value="{{ old('direccion_padre', $estudiante->direccion_padre) }}">
                    </div>

                    <div style="grid-column: span 4;">
                        <label>Departamento</label>
                        <input type="text" name="departamento_padre" class="form-input"
                               value="{{ old('departamento_padre', $estudiante->departamento_padre) }}">
                    </div>

                    <div style="grid-column: span 4;">
                        <label>Ciudad</label>
                        <input type="text" name="ciudad_padre" class="form-input"
                               value="{{ old('ciudad_padre', $estudiante->ciudad_padre) }}">
                    </div>
                </div>
            </div>

            {{-- ===== MADRE ===== --}}
            <div style="border: 1px solid #ddd; border-radius: 8px; padding: 20px;">
                <h4 style="margin-bottom: 15px; color: #4a148c;">👩 Madre</h4>

                <div style="display: grid; grid-template-columns: repeat(12, 1fr); gap: 15px;">
                    <div style="grid-column: span 4;">
                        <label>Nombre Completo</label>
                        <input type="text" name="nombre_madre" class="form-input"
                               value="{{ old('nombre_madre', $estudiante->nombre_madre) }}">
                    </div>

                    <div style="grid-column: span 4;">
                        <label>Documento</label>
                        <input type="text" name="documento_madre" class="form-input"
                               value="{{ old('documento_madre', $estudiante->documento_madre) }}">
                    </div>

                    <div style="grid-column: span 4;">
                        <label>Teléfono</label>
                        <input type="text" name="telefono_madre" class="form-input"
                               value="{{ old('telefono_madre', $estudiante->telefono_madre) }}">
                    </div>

                    <div style="grid-column: span 4;">
                        <label>Correo</label>
                        <input type="email" name="correo_madre" class="form-input"
                               value="{{ old('correo_madre', $estudiante->correo_madre) }}">
                    </div>

                    <div style="grid-column: span 4;">
                        <label>Direccion</label>
                        <input type="text" name="direccion_madre" class="form-input"
                               value="{{ old('direccion_madre', $estudiante->direccion_madre) }}">
                    </div>

                    <div style="grid-column: span 4;">
                        <label>Departamento</label>
                        <input type="text" name="departamento_madre" class="form-input"
                               value="{{ old('departamento_madre', $estudiante->departamento_madre) }}">
                    </div>

                    <div style="grid-column: span 4;">
                        <label>Ciudad</label>
                        <input type="text" name="ciudad_madre" class="form-input"
                               value="{{ old('ciudad_madre', $estudiante->ciudad_madre) }}">
                    </div>
                </div>
            </div>

        </div>

        {{-- ================= INFORMACIÓN MÉDICA ================= --}}
        <div style="background: white; padding: 25px; border-radius: 10px;
            box-shadow: 0 3px 8px rgba(0,0,0,0.1);
            margin-bottom: 30px;">

            <h3 style="color: #6a1b9a; margin-bottom: 20px;">
                Información médica
            </h3>

            <div style="display: grid; grid-template-columns: repeat(12, 1fr); gap: 18px;">

                <div style="grid-column: span 4;">
                    <label>Sistema de salud</label>
                    <select name="sistema_salud" class="form-input">
                        @foreach(['Contributivo','Subsidiado','Ninguno'] as $s)
                            <option value="{{ $s }}" {{ old('sistema_salud', $estudiante->sistema_salud) == $s ? 'selected' : '' }}>{{ $s }}</option>
                        @endforeach
                    </select>
                </div>

                <div style="grid-column: span 4;">
                    <label>Nombre EPS</label>
                    <input type="text" name="nombre_eps" class="form-input"
                           value="{{ old('nombre_eps', $estudiante->nombre_eps) }}">
                </div>

                <div style="grid-column: span 4;">
                    <label>¿Medicina prepagada?</label>
                    <select name="medicina_prepagada" id="medicina_prepagada" class="form-input">
                        <option value="1" {{ old('medicina_prepagada', $estudiante->medicina_prepagada) == 1 ? 'selected' : '' }}>Sí</option>
                        <option value="0" {{ old('medicina_prepagada', $estudiante->medicina_prepagada) == 0 ? 'selected' : '' }}>No</option>
                    </select>
                </div>

                <div id="entidad_medicina_prepagada" style="grid-column: span 6;">
                    <label>Entidad medicina prepagada</label>
                    <input type="text" name="entidad_medicina_prepagada" class="form-input"
                           value="{{ old('entidad_medicina_prepagada', $estudiante->entidad_medicina_prepagada) }}">
                </div>

                <div style="grid-column: span 6;">
                    <label>Contacto en caso de emergencia</label>
                    <input type="text" name="contacto_emergencia" class="form-input"
                           value="{{ old('contacto_emergencia', $estudiante->contacto_emergencia) }}">
                </div>

            </div>
        </div>

        {{-- ================= BOTÓN ================= --}}
        <div style="text-align: right;">
            <button type="submit"
                    style="background: #6a1b9a; color: white; padding: 12px 28px;
                           border: none; border-radius: 8px; font-weight: bold; cursor: pointer;">
                💾 Actualizar Estudiante
            </button>
        </div>

    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const otroClubSelect = document.getElementById('otro_club');
            const campoOtroClub = document.getElementById('nombre_otro_club');

            const medicinaSelect = document.getElementById('medicina_prepagada');
            const campoMedicina = document.getElementById('entidad_medicina_prepagada');

            function toggleOtroClub() {
                campoOtroClub.style.display = otroClubSelect.value == '1' ? 'block' : 'none';
            }

            function toggleMedicina() {
                campoMedicina.style.display = medicinaSelect.value == '1' ? 'block' : 'none';
            }

            // Ejecutar al cargar
            toggleOtroClub();
            toggleMedicina();

            // Escuchar cambios
            otroClubSelect.addEventListener('change', toggleOtroClub);
            medicinaSelect.addEventListener('change', toggleMedicina);
        });
    </script>

@endsection
