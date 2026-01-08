<?php

namespace App\Http\Controllers;

use App\Models\Ingreso;
use App\Models\Estudiante;
use App\Models\Recibo;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IngresoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $estudiantes = Estudiante::orderBy('nombre_completo')->get();

        $query = Ingreso::with(['estudiante', 'recibo']);

        // 🔹 Filtro por estudiante
        if ($request->filled('estudiante_id')) {
            $query->where('estudiante_id', $request->estudiante_id);
        }

        // 🔹 Filtro por mes (año actual)
        if ($request->filled('mes')) {
            $query->whereMonth('fecha', $request->mes)
                ->whereYear('fecha', now()->year);
        }

        // 🔹 Total según filtros (ANTES de paginar)
        $totalMes = (clone $query)->sum('valor');

        // 🔹 PAGINACIÓN
        $ingresos = $query
            ->orderBy('fecha', 'desc')
            ->paginate(10)
            ->withQueryString(); // mantiene filtros

        return view('ingresos.index', compact(
            'ingresos',
            'estudiantes',
            'totalMes'
        ));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $estudiantes = Estudiante::orderBy('nombre_completo')->get();

        return view('ingresos.create', compact('estudiantes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'estudiante_id' => 'required|exists:estudiantes,id',
            'concepto' => 'required|in:Matricula,Mensualidad,Póliza,Uniforme,Boletas,Torneos,Fisioterapia,Morral,Uniforme de Presentacion',
            'mes_correspondiente' => 'nullable|required_if:concepto,Mensualidad',
            'valor' => 'required|numeric|min:0',
            'medio_pago' => 'required|in:Transferencia,Cuenta Anterior 2025,Efectivo',
            'fecha' => 'required|date',
        ]);

        $ingreso = Ingreso::create([
            'estudiante_id' => $request->estudiante_id,
            'concepto' => $request->concepto,
            'mes_correspondiente' => $request->mes_correspondiente,
            'valor' => $request->valor,
            'medio_pago' => $request->medio_pago,
            'fecha' => $request->fecha,
        ]);

        $ultimoRecibo = Recibo::latest()->first();
        $numero = 'RC-' . str_pad(
                ($ultimoRecibo->id ?? 0) + 1,
                6,
                '0',
                STR_PAD_LEFT
            );

        // 3️⃣ Crear recibo
        $recibo = Recibo::create([
            'ingreso_id' => $ingreso->id,
            'numero' => $numero,
            'fecha' => now(),
            'valor' => $ingreso->valor,
        ]);

        // 4️⃣ Redirigir al recibo
        return redirect()
            ->route('recibos.show', $recibo->id)
            ->with('success', 'Ingreso registrado y recibo generado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ingreso $ingreso)
    {
        return view('ingresos.show', compact('ingreso'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ingreso $ingreso)
    {
        $estudiantes = Estudiante::orderBy('nombre_completo')->get();

        return view('ingresos.edit', compact('ingreso', 'estudiantes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ingreso $ingreso)
    {
        $request->validate([
            'estudiante_id' => 'required|exists:estudiantes,id',
            'concepto' => 'required|string',
            'mes_correspondiente' => 'nullable|string',
            'medio_pago' => 'required|string',
            'valor' => 'required|numeric|min:0',
            'fecha' => 'required|date',
        ]);

        // Si no es mensualidad, borrar el mes
        if ($request->concepto !== 'Mensualidad') {
            $request->merge(['mes_correspondiente' => null]);
        }

        $ingreso->update($request->all());

        return redirect()
            ->route('ingresos.index')
            ->with('success', 'Ingreso actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ingreso $ingreso)
    {
        $ingreso->delete();

        return redirect()
            ->route('ingresos.index')
            ->with('success', 'Ingreso eliminado correctamente');
    }
}
