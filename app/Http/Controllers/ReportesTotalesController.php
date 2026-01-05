<?php

namespace App\Http\Controllers;

use App\Models\Ingreso;
use App\Models\Estudiante;
use Illuminate\Http\Request;

class ReportesTotalesController extends Controller
{
    public function index(Request $request)
    {
        $mes  = $request->mes ?? now()->month;
        $anio = $request->anio ?? now()->year;
        $estudianteId = $request->estudiante_id;

        $estudiantes = Estudiante::orderBy('nombre_completo')->get();

        $query = Ingreso::whereYear('fecha', $anio)
            ->whereMonth('fecha', $mes);

        if ($estudianteId) {
            $query->where('estudiante_id', $estudianteId);
        }

        $totalGeneral = $query->sum('valor');

        $totalesPorConcepto = (clone $query)
            ->selectRaw('concepto, SUM(valor) as total')
            ->groupBy('concepto')
            ->orderBy('concepto')
            ->get();

        $totalesPorMedioPago = (clone $query)
            ->selectRaw('medio_pago, SUM(valor) as total')
            ->groupBy('medio_pago')
            ->get();

        return view('ingresos.reportesTotales', compact(
            'mes',
            'anio',
            'estudianteId',
            'estudiantes',
            'totalGeneral',
            'totalesPorConcepto',
            'totalesPorMedioPago'
        ));
    }
}
