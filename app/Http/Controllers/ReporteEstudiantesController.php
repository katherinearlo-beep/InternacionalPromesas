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
        $mes  = $request->mes;
        $anio = $request->anio ?? now()->year;

        $ingresos = collect();
        $total = 0;

        if ($estudianteId) {
            $ingresos = Ingreso::with('estudiante')
                ->where('estudiante_id', $estudianteId)
                ->when($mes, function ($query) use ($mes) {
                    $query->whereMonth('fecha', $mes);
                })
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

    // Método para mostrar estudiantes por categoría
    public function reportePorCategoria(Request $request)
    {
        // Obtenemos la categoría desde la solicitud
        $categoria = $request->input('categoria');

        // Si se selecciona una categoría, filtramos los estudiantes por categoría
        if ($categoria) {
            $estudiantes = Estudiante::where('categoria', $categoria)->get();
        } else {
            // Si no hay categoría seleccionada, mostramos todos los estudiantes
            $estudiantes = Estudiante::all();
        }

        // Retornamos la vista con los estudiantes filtrados
        return view('reporteEstudiantes.categoria', compact('estudiantes'));
    }
}
