@extends('layout')

@section('content')

    {{-- ================= HEADER ================= --}}
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
        <h1 style="color: #4a148c;">➕ Nuevo Estudiante</h1>

        <a href="{{ route('estudiantes.index') }}"
           style="background: #e0e0e0; color: #333; padding: 10px 18px;
                  text-decoration: none; border-radius: 6px; font-weight: bold;">
            ⬅ Volver
        </a>
    </div>

    <form action="{{ route('estudiantes.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

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
                    <input
                        type="text"
                        name="documento"
                        required
                        class="form-input"
                        value="{{ old('documento') }}"
                    >

                    @error('documento')
                    <small style="color: #e3342f;">{{ $message }}</small>
                    @enderror
                </div>

                <div style="grid-column: span 8;">
                    <label>Nombre completo *</label>
                    <input type="text" name="nombre_completo" required class="form-input">
                </div>

                <div style="grid-column: span 4;">
                    <label>Teléfono</label>
                    <input type="text" name="telefono" class="form-input">
                </div>

                <div style="grid-column: span 8;">
                    <label>Dirección</label>
                    <input type="text" name="direccion" class="form-input">
                </div>

                <div style="grid-column: span 4;">
                    <label>Fecha de nacimiento *</label>
                    <input type="date" name="fecha_nacimiento" required class="form-input">
                </div>

                <div style="grid-column: span 4;">
                    <label>Ciudad de nacimiento *</label>
                    <input type="text" name="ciudad_nacimiento" required class="form-input">
                </div>

                <div style="grid-column: span 4;">
                    <label>Departamento *</label>
                    <input type="text" name="departamento_nacimiento" required class="form-input">
                </div>

                <div style="grid-column: span 4;">
                    <label>Fecha de ingreso *</label>
                    <input type="date" name="fecha_ingreso" required class="form-input">
                </div>

            </div>
        </div>

        {{-- ================= DATOS ADICIONALES ================= --}}
        <div style="background: white; padding: 25px; border-radius: 10px;
            box-shadow: 0 3px 8px rgba(0,0,0,0.1);
            margin-bottom: 30px;">

            <h3 style="color: #6a1b9a; margin-bottom: 20px;">
                Información deportiva
            </h3>

            <div style="display: grid; grid-template-columns: repeat(12, 1fr); gap: 18px;">

                <div style="grid-column: span 4;">
                    <label>Foto del alumno</label>
                    <input type="file" name="foto" class="form-input" accept="image/*">
                </div>

                <div style="grid-column: span 4;">
                    <label>Sexo</label>
                    <select name="sexo" class="form-input">
                        <option value="">Seleccione</option>
                        <option value="masculino">Masculino</option>
                        <option value="femenino">Femenino</option>
                        <option value="sin_definir">Sin definir</option>
                    </select>
                </div>

                <div style="grid-column: span 2;">
                    <label>Edad</label>
                    <input type="number" name="edad" class="form-input">
                </div>

                <div style="grid-column: span 2;">
                    <label>Peso (kg)</label>
                    <input type="number" step="0.1" name="peso" class="form-input">
                </div>

                <div style="grid-column: span 2;">
                    <label>Altura (cm)</label>
                    <input type="number" name="altura" class="form-input">
                </div>

                <div style="grid-column: span 3;">
                    <label>Talla uniforme</label>
                    <input type="text" name="talla_uniforme" class="form-input">
                </div>

                <div style="grid-column: span 3;">
                    <label>Categoría</label>
                    <select name="categoria" class="form-input">
                        <option value="">Seleccione</option>
                        <option>Estimulación</option>
                        <option>SUB 6</option>
                        <option>SUB 7</option>
                        <option>SUB 8</option>
                        <option>SUB 9</option>
                        <option>SUB 10</option>
                        <option>SUB 11 Rendimiento</option>
                        <option>SUB 11 Academia</option>
                        <option>SUB 12 Rendimiento</option>
                        <option>SUB 12 Academia</option>
                        <option>SUB 13 Rendimiento</option>
                        <option>SUB 13 Academia</option>
                        <option>SUB 14 Rendimiento</option>
                        <option>SUB 14 Academia</option>
                        <option>SUB 15 Academia</option>
                        <option>SUB 15 Rendimiento</option>
                        <option>SUB 16 Rendimiento</option>
                        <option>SUB 17 Rendimiento</option>
                        <option>Administrativo</option>
                    </select>
                </div>

                <div style="grid-column: span 3;">
                    <label>Modalidad de contrato</label>
                    <select name="modalidad_contrato" class="form-input">
                        <option value="">Seleccione</option>
                        <option value="mensual">Mensual</option>
                        <option value="becado_50">Becado 50%</option>
                        <option value="becado_100">Becado 100%</option>
                    </select>
                </div>

                <div style="grid-column: span 3;">
                    <label>Sede</label>
                    <select name="sede" class="form-input">
                        <option value="">Seleccione</option>
                        <option>Itagui</option>
                        <option>Envigado</option>
                        <option>Medellín</option>
                        <option>Administrativa</option>
                    </select>
                </div>

                <div style="grid-column: span 3;">
                    <label>Precio mensualidad</label>
                    <input type="number" step="0.01" name="precio_mensualidad" class="form-input">
                </div>

            </div>
        </div>

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
                        <option value="">Seleccione</option>
                        <option value="1">Sí</option>
                        <option value="0">No</option>
                    </select>
                </div>

                <div id="nombre_otro_club" style="grid-column: span 8;">
                    <label>Nombre del club</label>
                    <input type="text" name="nombre_otro_club" class="form-input">
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
                        <input type="text" name="nombre_padre" class="form-input">
                    </div>

                    <div style="grid-column: span 4;">
                        <label>Documento</label>
                        <input type="text" name="documento_padre" class="form-input">
                    </div>

                    <div style="grid-column: span 4;">
                        <label>Teléfono</label>
                        <input type="text" name="telefono_padre" class="form-input">
                    </div>

                    <div style="grid-column: span 4;">
                        <label>Correo</label>
                        <input type="email" name="correo_padre" class="form-input">
                    </div>

                    <div style="grid-column: span 4;">
                        <label>Direccion</label>
                        <input type="text" name="direccion_padre" class="form-input">
                    </div>

                    <div style="grid-column: span 4;">
                        <label>Departamento</label>
                        <input type="text" name="departamento_padre" class="form-input">
                    </div>

                    <div style="grid-column: span 4;">
                        <label>Ciudad</label>
                        <input type="text" name="ciudad_padre" class="form-input">
                    </div>
                </div>
            </div>

            {{-- ===== MADRE ===== --}}
            <div style="border: 1px solid #ddd; border-radius: 8px; padding: 20px;">
                <h4 style="margin-bottom: 15px; color: #4a148c;">👩 Madre</h4>

                <div style="display: grid; grid-template-columns: repeat(12, 1fr); gap: 15px;">
                    <div style="grid-column: span 4;">
                        <label>Nombre Completo</label>
                        <input type="text" name="nombre_madre" class="form-input">
                    </div>

                    <div style="grid-column: span 4;">
                        <label>Documento</label>
                        <input type="text" name="documento_madre" class="form-input">
                    </div>

                    <div style="grid-column: span 4;">
                        <label>Teléfono</label>
                        <input type="text" name="telefono_madre" class="form-input">
                    </div>

                    <div style="grid-column: span 4;">
                        <label>Correo</label>
                        <input type="email" name="correo_madre" class="form-input">
                    </div>

                    <div style="grid-column: span 4;">
                        <label>Direccion</label>
                        <input type="text" name="direccion_madre" class="form-input">
                    </div>

                    <div style="grid-column: span 4;">
                        <label>Departamento</label>
                        <input type="text" name="departamento_madre" class="form-input">
                    </div>

                    <div style="grid-column: span 4;">
                        <label>Ciudad</label>
                        <input type="text" name="ciudad_madre" class="form-input">
                    </div>
                </div>
            </div>

        </div>

        {{-- ================= CAMPOS MEDICOS ================= --}}
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
                        <option value="">Seleccione</option>
                        <option>Contributivo</option>
                        <option>Subsidiado</option>
                        <option>Ninguno</option>
                    </select>
                </div>

                <div style="grid-column: span 4;">
                    <label>Nombre EPS</label>
                    <input type="text" name="nombre_eps" class="form-input">
                </div>

                <div style="grid-column: span 4;">
                    <label>¿Tiene medicina prepagada?</label>
                    <select name="medicina_prepagada" id="medicina_prepagada" class="form-input">
                        <option value="">Seleccione</option>
                        <option value="1">Sí</option>
                        <option value="0">No</option>
                    </select>
                </div>

                <div id="entidad_medicina_prepagada" style="grid-column: span 6;">
                    <label>Entidad medicina prepagada</label>
                    <input type="text" name="entidad_medicina_prepagada" class="form-input">
                </div>

                <div style="grid-column: span 6;">
                    <label>¿Ha sufrido enfermedad grave o accidente (últimos 2 años)?</label>
                    <select name="enfermedad_grave" class="form-input">
                        <option value="">Seleccione</option>
                        <option value="1">Sí</option>
                        <option value="0">No</option>
                    </select>
                </div>

                <div style="grid-column: span 6;">
                    <label>¿Enfermedad respiratoria medicada?</label>
                    <select name="enfermedad_respiratoria" class="form-input">
                        <option value="">Seleccione</option>
                        <option value="1">Sí</option>
                        <option value="0">No</option>
                    </select>
                </div>

                <div style="grid-column: span 6;">
                    <label>¿Apto para competencia deportiva?</label>
                    <select name="apto_deporte" class="form-input">
                        <option value="">Seleccione</option>
                        <option value="1">Sí</option>
                        <option value="0">No</option>
                    </select>
                </div>

                <div style="grid-column: span 6;">
                    <label>Contacto en caso de emergencia</label>
                    <input type="text" name="contacto_emergencia" class="form-input">
                </div>

            </div>
        </div>

        {{-- ================= BOTÓN ================= --}}
        <div style="text-align: right;">
            <button type="submit"
                    style="background: #6a1b9a; color: white; padding: 12px 28px;
                           border: none; border-radius: 8px; font-weight: bold; cursor: pointer;">
                💾 Guardar Estudiante
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
