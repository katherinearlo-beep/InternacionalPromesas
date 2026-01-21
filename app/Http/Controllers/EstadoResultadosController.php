<?php

namespace App\Http\Controllers;

use App\Models\Ingreso;
use App\Models\Gasto;
use Illuminate\Http\Request;

class EstadoResultadosController extends Controller
{
    public function index(Request $request)
    {
        $mes  = $request->mes;
        $anio = $request->anio;

        /* =======================
         * INGRESOS AGRUPADOS
         * ======================= */
        $ingresosQuery = Ingreso::selectRaw('concepto, SUM(valor) as total')
            ->groupBy('concepto');

        if ($anio) {
            $ingresosQuery->whereYear('fecha', $anio);
        }

        if ($mes) {
            $ingresosQuery->whereMonth('fecha', $mes);
        }

        $ingresos = $ingresosQuery->get();

        $totalIngresos = $ingresos->sum('total');

        /* =======================
         * GASTOS AGRUPADOS
         * ======================= */
        $gastosQuery = Gasto::selectRaw('concepto, SUM(valor) as total')
            ->groupBy('concepto');

        if ($anio) {
            $gastosQuery->whereYear('fecha', $anio);
        }

        if ($mes) {
            $gastosQuery->whereMonth('fecha', $mes);
        }

        $gastos = $gastosQuery->get();

        $totalGastos = $gastos->sum('total');

        /* =======================
         * RESULTADO
         * ======================= */
        $resultado = $totalIngresos - $totalGastos;

        return view('reportes.estado_resultados', compact(
            'mes',
            'anio',
            'ingresos',
            'gastos',
            'totalIngresos',
            'totalGastos',
            'resultado'
        ));
    }
}

