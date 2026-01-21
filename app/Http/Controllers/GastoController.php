<?php

namespace App\Http\Controllers;

use App\Models\Gasto;
use Illuminate\Http\Request;

class GastoController extends Controller
{
    /**
     * Listado de gastos
     * GET /gastos
     */
    public function index(Request $request)
    {
        $query = Gasto::query();

        // Filtro por sede
        if ($request->filled('sede')) {
            $query->where('sede', $request->sede);
        }

        // Filtro por rango de fechas
        if ($request->filled('desde')) {
            $query->whereDate('fecha', '>=', $request->desde);
        }

        if ($request->filled('hasta')) {
            $query->whereDate('fecha', '<=', $request->hasta);
        }

        $gastos = $query
            ->orderBy('fecha', 'desc')
            ->paginate(15);

        return view('gastos.index', compact('gastos'));
    }

    /**
     * Formulario de creación
     * GET /gastos/crear
     */
    public function create()
    {
        return view('gastos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'fecha'    => ['required', 'date'],
            'nit'      => ['required', 'string', 'max:30'],
            'nombre'   => ['required', 'string', 'max:255'],
            'concepto' => ['required', 'string', 'max:255'],
            'sede'     => ['required', 'in:envigado,itagui'],
            'valor'    => ['required', 'numeric', 'min:0'],
        ], [
            'fecha.required'    => 'La fecha del gasto es obligatoria.',
            'nit.required'      => 'El NIT es obligatorio.',
            'nombre.required'   => 'El nombre es obligatorio.',
            'concepto.required' => 'El concepto es obligatorio.',
            'sede.required'     => 'Debe seleccionar una sede.',
            'sede.in'           => 'La sede seleccionada no es válida.',
            'valor.required'    => 'El valor del gasto es obligatorio.',
        ]);

        Gasto::create([
            'fecha'    => $request->fecha,
            'nit'      => $request->nit,
            'nombre'   => $request->nombre,
            'concepto' => $request->concepto,
            'sede'     => $request->sede,
            'valor'    => $request->valor,
        ]);

        return redirect()
            ->route('gastos.index')
            ->with('success', 'Gasto registrado correctamente');
    }

    /**
     * Reportes de gastos
     * GET /gastos/reportes
     */
    public function reportes(Request $request)
    {
        $query = Gasto::query();

        if ($request->filled('sede')) {
            $query->where('sede', $request->sede);
        }

        if ($request->filled('mes')) {
            $query->whereMonth('fecha', $request->mes);
        }

        if ($request->filled('anio')) {
            $query->whereYear('fecha', $request->anio);
        }

        $gastos = $query->get();

        $total = $gastos->sum('valor');

        return view('gastos.reportes', compact('gastos', 'total'));
    }
}
