<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\Ingreso;
use Illuminate\Http\Request;

class ReporteCarteraController extends Controller
{
    public function carteraPorCategoria(Request $request)
    {
        $categoria = $request->categoria;
        $mesActual = $request->mes;
        $anio = $request->anio ?? date('Y');

        $meses = [
            'Enero','Febrero','Marzo','Abril','Mayo','Junio',
            'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'
        ];

        $mesesReporte = [];
        $reporte = [];

        // SOLO si ya seleccionaron categoría y mes
        if ($categoria && $mesActual) {

            $mesesReporte = array_slice(
                $meses,
                0,
                array_search($mesActual, $meses) + 1
            );

            $estudiantes = Estudiante::where('categoria', $categoria)->get();

            foreach ($estudiantes as $estudiante) {

                $fila = [
                    'estudiante' => $estudiante->nombre_completo,
                    'meses' => [],
                    'total' => 0,
                    'meses_mora' => 0,
                ];

                foreach ($mesesReporte as $mes) {

                    $pago = Ingreso::where('estudiante_id', $estudiante->id)
                        ->where('concepto', 'Mensualidad')
                        ->where('mes_correspondiente', $mes)
                        ->whereYear('fecha', $anio)
                        ->sum('valor');

                    if ($pago > 0) {
                        $fila['meses'][$mes] = $pago;
                        $fila['total'] += $pago;
                    } else {
                        $fila['meses'][$mes] = null;

                        if ($mes !== $mesActual) {
                            $fila['meses_mora']++;
                        }
                    }
                }

                $reporte[] = $fila;
            }
        }

        // Categorías únicas para el filtro
        $categorias = Estudiante::select('categoria')
            ->distinct()
            ->orderBy('categoria')
            ->pluck('categoria');

        return view('cartera.index', compact(
            'categorias',
            'categoria',
            'mesActual',
            'anio',
            'mesesReporte',
            'reporte'
        ));
    }
}
