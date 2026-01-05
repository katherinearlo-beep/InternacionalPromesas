<?php

namespace App\Http\Controllers;

use App\Models\Ingreso;
use App\Models\Estudiante;
use Illuminate\Http\Request;

class ReporteEstudiantesController extends Controller
{
    public function reporteEstudiantes(Request $request)
    {
        $estudiantes = Estudiante::orderBy('nombre_completo')->get();

        $estudianteId = $request->estudiante_id;
        $mes  = $request->mes ?? now()->month;
        $anio = $request->anio ?? now()->year;

        $ingresos = collect();
        $total = 0;

        if ($estudianteId) {
            $ingresos = Ingreso::with('estudiante')
                ->where('estudiante_id', $estudianteId)
                ->whereMonth('fecha', $mes)
                ->whereYear('fecha', $anio)
                ->orderBy('fecha')
                ->get();

            $total = $ingresos->sum('valor');
        }

        return view('reporteEstudiantes.index', compact(
            'estudiantes',
            'ingresos',
            'estudianteId',
            'mes',
            'anio',
            'total'
        ));
    }
}
