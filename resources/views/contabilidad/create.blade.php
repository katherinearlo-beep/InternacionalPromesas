@extends('layout')

@section('content')
    <div class="container py-4">
        <h2 class="mb-4 text-purple fw-bold">Nuevo Asiento Contable</h2>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form id="entryForm" action="{{ route('contabilidad.store') }}" method="POST">
            @csrf

            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label">Tipo *</label>
                            <select name="tipo" class="form-select" required>
                                <option value="">Seleccione...</option>
                                <option>RC</option><option>FC</option><option>FV</option>
                                <option>EG</option><option>IG</option><option>AJ</option>
                                <option>NC</option><option>NB</option><option>NCN</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Número *</label>
                            <input type="number" name="numero" class="form-control" required>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Documento</label>
                            <input type="text" name="documento" class="form-control">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Fecha *</label>
                            <input type="date" name="fecha" class="form-control" required>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Observaciones</label>
                            <textarea name="observaciones" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm mb-3">
                <div class="card-header bg-purple text-white">
                    <strong>Movimientos contables</strong>
                </div>
                <div class="card-body" style="max-height: 400px; overflow-y: auto;">
                    <table class="table table-sm table-bordered align-middle text-center" id="movimientosTable">
                        <thead class="table-light">
                        <tr>
                            <th>Cuenta</th>
                            <th>Nombre cuenta</th>
                            <th>Débito</th>
                            <th>Crédito</th>
                            <th>Observaciones</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><input type="text" name="movimientos[0][cuenta]" class="form-control cuenta-input" required autocomplete="off"></td>
                            <td><input type="text" name="movimientos[0][nombre_cuenta]" class="form-control nombre_cuenta" readonly></td>
                            <td><input type="number" step="0.01" name="movimientos[0][debito]" class="form-control text-end debito" value="0"></td>
                            <td><input type="number" step="0.01" name="movimientos[0][credito]" class="form-control text-end credito" value="0"></td>
                            <td><input type="text" name="movimientos[0][observaciones]" class="form-control"></td>
                            <td><button type="button" class="btn btn-danger btn-sm remove-row">✕</button></td>
                        </tr>
                        </tbody>
                    </table>
                    <button type="button" id="addRow" class="btn btn-secondary btn-sm mt-2">+ Agregar línea</button>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-body d-flex justify-content-between">
                    <div>
                        <strong>Total Débito: </strong> <span id="total-debito">0.00</span>
                        &nbsp; | &nbsp;
                        <strong>Total Crédito: </strong> <span id="total-credito">0.00</span>
                    </div>
                    <button type="submit" class="btn btn-purple px-4 fw-bold">💾 Guardar Asiento</button>
                </div>
            </div>
        </form>
    </div>

    {{-- ======================= JS ======================= --}}
    <script>
        let rowCount = 1;

        // --- Agregar fila nueva ---
        document.getElementById('addRow').addEventListener('click', function() {
            const tbody = document.querySelector('#movimientosTable tbody');
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
        <td><input type="text" name="movimientos[${rowCount}][cuenta]" class="form-control cuenta-input" required autocomplete="off"></td>
        <td><input type="text" name="movimientos[${rowCount}][nombre_cuenta]" class="form-control nombre_cuenta" readonly></td>
        <td><input type="number" step="0.01" name="movimientos[${rowCount}][debito]" class="form-control text-end debito" value="0"></td>
        <td><input type="number" step="0.01" name="movimientos[${rowCount}][credito]" class="form-control text-end credito" value="0"></td>
        <td><input type="text" name="movimientos[${rowCount}][observaciones]" class="form-control"></td>
        <td><button type="button" class="btn btn-danger btn-sm remove-row">✕</button></td>
    `;
            tbody.appendChild(newRow);
            activarAutocomplete(newRow.querySelector('.cuenta-input'));
            rowCount++;
        });

        // --- Eliminar fila ---
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-row')) {
                e.target.closest('tr').remove();
                actualizarTotales();
            }
        });

        // --- Calcular totales ---
        document.addEventListener('input', function(e) {
            if (e.target.classList.contains('debito') || e.target.classList.contains('credito')) {
                actualizarTotales();
            }
        });

        function actualizarTotales() {
            let totalDebito = 0, totalCredito = 0;
            document.querySelectorAll('.debito').forEach(el => totalDebito += parseFloat(el.value) || 0);
            document.querySelectorAll('.credito').forEach(el => totalCredito += parseFloat(el.value) || 0);
            document.getElementById('total-debito').textContent = totalDebito.toFixed(2);
            document.getElementById('total-credito').textContent = totalCredito.toFixed(2);
        }

        // --- Autocompletado de cuentas PUC ---
        function activarAutocomplete(input) {
            let box = document.createElement('div');
            box.className = 'autocomplete-suggestions';
            box.style.display = 'none';
            document.body.appendChild(box);

            input.addEventListener('input', async () => {
                const term = input.value.trim();
                if (term.length < 2) { box.style.display = 'none'; return; }

                const res = await fetch(`/puc/search?term=${term}`);
                const data = await res.json();

                box.innerHTML = '';
                if (data.length === 0) { box.style.display = 'none'; return; }

                data.forEach(item => {
                    const div = document.createElement('div');
                    div.className = 'suggestion-item';
                    div.textContent = `${item.codigo} - ${item.nombre}`;
                    div.onclick = () => {
                        input.value = item.codigo;
                        input.closest('tr').querySelector('.nombre_cuenta').value = item.nombre;
                        box.style.display = 'none';
                    };
                    box.appendChild(div);
                });

                const rect = input.getBoundingClientRect();
                box.style.left = `${rect.left + window.scrollX}px`;
                box.style.top = `${rect.bottom + window.scrollY}px`;
                box.style.width = `${rect.width}px`;
                box.style.display = 'block';
            });

            document.addEventListener('click', e => {
                if (!box.contains(e.target) && e.target !== input) box.style.display = 'none';
            });
        }

        // activar autocomplete inicial
        activarAutocomplete(document.querySelector('.cuenta-input'));
    </script>

    {{-- ======================= ESTILOS ======================= --}}
    <style>
        .text-purple { color: #5e35b1; }
        .bg-purple { background-color: #5e35b1; }
        .btn-purple {
            background-color: #5e35b1;
            color: white;
            border: none;
            transition: all 0.2s;
        }
        .btn-purple:hover { background-color: #4527a0; }

        /* Estilo del autocomplete */
        .autocomplete-suggestions {
            position: absolute;
            background: #fff;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
            z-index: 1000;
            max-height: 200px;
            overflow-y: auto;
        }
        .suggestion-item {
            padding: 8px 10px;
            cursor: pointer;
        }
        .suggestion-item:hover {
            background: #ede7f6;
            color: #4a148c;
            font-weight: bold;
        }
    </style>
@endsection
