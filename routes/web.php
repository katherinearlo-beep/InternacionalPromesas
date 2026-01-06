<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('contabilidad')->group(function () {
    Route::get('/', [AccountingEntryController::class, 'index'])->name('contabilidad.index');
    Route::get('/nuevo', [AccountingEntryController::class, 'create'])->name('contabilidad.create');
    Route::post('/guardar', [AccountingEntryController::class, 'store'])->name('contabilidad.store');
    Route::get('/{id}', [AccountingEntryController::class, 'show'])->name('contabilidad.show');
    Route::get('/{id}/editar', [AccountingEntryController::class, 'edit'])->name('contabilidad.edit');
    Route::put('/{id}', [AccountingEntryController::class, 'update'])->name('contabilidad.update');
    Route::delete('/{id}', [AccountingEntryController::class, 'destroy'])->name('contabilidad.destroy');
    Route::get('/contabilidad/{id}/imprimir', [AccountingEntryController::class, 'print'])->name('contabilidad.print');
});

Route::view('/', 'home')->name('home');
Route::view('/reportes', 'reportes')->name('reportes');
Route::prefix('reportes')->group(function () {
    Route::get('/estado-situacion-financiera', [ReportesController::class, 'estadoSituacionFinanciera'])->name('reportes.situacion');
    Route::get('/estado-resultados-mensual', [ReportesController::class, 'estadoResultadosMensual'])->name('reportes.resultados.mensual');
    Route::get('/estado-resultados-acumulado', [ReportesController::class, 'estadoResultadosAcumulado'])->name('reportes.resultados.acumulado');
    Route::get('/estado-situacion-financiera/print', [ReportesController::class, 'estadoSituacionFinancieraPrint'])->name('reportes.estadoSituacionFinancieraPrint');
});

Route::get('/puc/search', [PucController::class, 'search'])->name('puc.search');

Route::resource('estudiantes', EstudianteController::class);
Route::get('estudiantes/{estudiante}/pdf', [EstudianteController::class, 'pdf'])
    ->name('estudiantes.pdf');
Route::resource('ingresos', IngresoController::class);

Route::get('/reporte-estudiantes',
    [ReporteEstudiantesController::class, 'reporteEstudiantes']
)->name('reporteEstudiantes.index');

Route::get('/reportes-totales', [ReportesTotalesController::class, 'index'])
    ->name('reportesTotales.index');
Route::get('/recibos/{recibo}', [ReciboController::class, 'show'])
    ->name('recibos.show');
Route::get('/recibos/{recibo}/pdf', [ReciboController::class, 'pdf'])
    ->name('recibos.pdf');

Route::resource('users', UserController::class)->middleware('auth');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
