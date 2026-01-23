<<?php

use App\Http\Controllers\AccountingEntryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\IngresoController;
use App\Http\Controllers\PucController;
use App\Http\Controllers\ReciboController;
use App\Http\Controllers\ReportesController;
use App\Http\Controllers\ReporteEstudiantesController;
use App\Http\Controllers\ReportesTotalesController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| RUTA RAÍZ → LOGIN
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return redirect()->route('login');
});

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| RUTAS PROTEGIDAS (SOLO LOGUEADOS)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    Route::view('/home', 'home')->name('home');

    /*
    |--------------------------------------------------------------------------
    | CONTABILIDAD
    |--------------------------------------------------------------------------
    */
    Route::prefix('contabilidad')->group(function () {
        Route::get('/', [AccountingEntryController::class, 'index'])->name('contabilidad.index');
        Route::get('/nuevo', [AccountingEntryController::class, 'create'])->name('contabilidad.create');
        Route::post('/guardar', [AccountingEntryController::class, 'store'])->name('contabilidad.store');
        Route::get('/{id}', [AccountingEntryController::class, 'show'])->name('contabilidad.show');
        Route::get('/{id}/editar', [AccountingEntryController::class, 'edit'])->name('contabilidad.edit');
        Route::put('/{id}', [AccountingEntryController::class, 'update'])->name('contabilidad.update');
        Route::delete('/{id}', [AccountingEntryController::class, 'destroy'])->name('contabilidad.destroy');
        Route::get('/{id}/imprimir', [AccountingEntryController::class, 'print'])->name('contabilidad.print');
    });

    /*
    |--------------------------------------------------------------------------
    | REPORTES
    |--------------------------------------------------------------------------
    */
    Route::view('/reportes', 'reportes')->name('reportes');

    Route::prefix('reportes')->group(function () {
        Route::get('/estado-situacion-financiera', [ReportesController::class, 'estadoSituacionFinanciera'])->name('reportes.situacion');
        Route::get('/estado-resultados-mensual', [ReportesController::class, 'estadoResultadosMensual'])->name('reportes.resultados.mensual');
        Route::get('/estado-resultados-acumulado', [ReportesController::class, 'estadoResultadosAcumulado'])->name('reportes.resultados.acumulado');
        Route::get('/estado-situacion-financiera/print', [ReportesController::class, 'estadoSituacionFinancieraPrint'])->name('reportes.estadoSituacionFinancieraPrint');
    });

    /*
    |--------------------------------------------------------------------------
    | OTROS MÓDULOS
    |--------------------------------------------------------------------------
    */
    Route::get('/puc/search', [PucController::class, 'search'])->name('puc.search');

    Route::resource('estudiantes', EstudianteController::class);
    Route::get('estudiantes/{estudiante}/pdf', [EstudianteController::class, 'pdf'])->name('estudiantes.pdf');

    Route::resource('ingresos', IngresoController::class);

    Route::get('/reporte-estudiantes', [ReporteEstudiantesController::class, 'reporteEstudiantes'])
        ->name('reporteEstudiantes.index');
    Route::get('/reporte-categoria', [ReporteEstudiantesController::class, 'reportePorCategoria'])->name('reporteEstudiantes.categoria');

    Route::get('/reportes-totales', [ReportesTotalesController::class, 'index'])
        ->name('reportesTotales.index');

    Route::get('/recibos/{recibo}', [ReciboController::class, 'show'])->name('recibos.show');
    Route::get('/recibos/{recibo}/pdf', [ReciboController::class, 'pdf'])->name('recibos.pdf');

    Route::get('/gastos', [GastoController::class, 'index'])->name('gastos.index');
    Route::post('/gastos', [GastoController::class, 'store'])->name('gastos.store');
    Route::get('/gastos/crear', [GastoController::class, 'create'])->name('gastos.create');
    Route::get('/gastos/reportes', [GastoController::class, 'reportes'])->name('gastos.reportes');
     Route::get('/gastos/{gasto}/editar', [GastoController::class, 'edit'])->name('gastos.edit');
    Route::put('/gastos/{gasto}', [GastoController::class, 'update'])->name('gastos.update');
    Route::delete('/gastos/{gasto}', [GastoController::class, 'destroy'])->name('gastos.destroy');

    Route::get('/reportes/estado-resultados', [EstadoResultadosController::class, 'index'])->name('reportes.estado-resultados');
    
    Route::get('/cartera', [ReporteCarteraController::class, 'carteraPorCategoria'])->name('cartera.index');

    Route::resource('users', UserController::class);
});
