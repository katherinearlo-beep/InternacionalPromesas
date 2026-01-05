<?php

namespace App\Http\Controllers;

use App\Models\AccountingMovement;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportesController extends Controller
{
    public function estadoSituacionFinanciera()
    {
        // Agrupar movimientos por tipo (1 = activos, 2 = pasivos, 3 = patrimonio)
        $movimientos = AccountingMovement::select(
            'cuenta',
            'nombre_cuenta',
            DB::raw('SUM(debito) as total_debito'),
            DB::raw('SUM(credito) as total_credito')
        )
            ->groupBy('cuenta', 'nombre_cuenta')
            ->orderBy('cuenta')
            ->get();

        // Clasificar por tipo de cuenta
        $activos = $movimientos->filter(fn($m) => str_starts_with($m->cuenta, '1'));
        $pasivos = $movimientos->filter(fn($m) => str_starts_with($m->cuenta, '2'));
        $patrimonio = $movimientos->filter(fn($m) => str_starts_with($m->cuenta, '3'));

        // Calcular totales
        $totalActivos = $activos->sum(fn($m) => $m->total_debito - $m->total_credito);
        $totalPasivos = $pasivos->sum(fn($m) => $m->total_credito - $m->total_debito);
        $totalPatrimonio = $patrimonio->sum(fn($m) => $m->total_credito - $m->total_debito);

        $fecha = Carbon::now();

        return view('reportes.estado_situacion_financiera', compact(
            'activos',
            'pasivos',
            'patrimonio',
            'totalActivos',
            'totalPasivos',
            'totalPatrimonio',
            'fecha'
        ));
    }

    public function estadoResultadosMensual()
    {
        return view('reportes.estado_resultados_mensual');
    }

    public function estadoResultadosAcumulado()
    {
        return view('reportes.estado_resultados_acumulado');
    }

    public function estadoSituacionFinancieraPrint()
    {
        // Agrupar movimientos por cuenta
        $movimientos = AccountingMovement::select(
            'cuenta',
            'nombre_cuenta',
            DB::raw('SUM(debito) as total_debito'),
            DB::raw('SUM(credito) as total_credito')
        )
            ->groupBy('cuenta', 'nombre_cuenta')
            ->orderBy('cuenta')
            ->get();

        // Clasificar por tipo de cuenta
        $activos = $movimientos->filter(fn($m) => str_starts_with($m->cuenta, '1'));
        $pasivos = $movimientos->filter(fn($m) => str_starts_with($m->cuenta, '2'));
        $patrimonio = $movimientos->filter(fn($m) => str_starts_with($m->cuenta, '3'));

        // Calcular totales
        $totalActivos = $activos->sum(fn($m) => $m->total_debito - $m->total_credito);
        $totalPasivos = $pasivos->sum(fn($m) => $m->total_credito - $m->total_debito);
        $totalPatrimonio = $patrimonio->sum(fn($m) => $m->total_credito - $m->total_debito);

        $fecha = Carbon::now();

        // Retornar la vista de impresión con los datos reales
        return view('reportes.estado_situacion_financiera_print', compact(
            'activos',
            'pasivos',
            'patrimonio',
            'totalActivos',
            'totalPasivos',
            'totalPatrimonio',
            'fecha'
        ));
    }
}
