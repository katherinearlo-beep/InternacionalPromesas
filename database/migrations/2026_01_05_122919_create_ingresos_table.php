<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ingresos', function (Blueprint $table) {
            $table->id();

            // Relación con estudiante
            $table->foreignId('estudiante_id')
                ->constrained('estudiantes')
                ->onDelete('cascade');


            // Fecha del ingreso
            $table->date('fecha');

            // Concepto
            $table->enum('concepto', [
                'Matricula',
                'Mensualidad',
                'Póliza',
                'Uniforme',
                'Boletas',
                'Torneos',
            ]);

            // Solo para mensualidades
            $table->enum('mes_correspondiente', [
                'Enero', 'Febrero', 'Marzo', 'Abril',
                'Mayo', 'Junio', 'Julio', 'Agosto',
                'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
            ])->nullable();

            // Valor del ingreso
            $table->decimal('valor', 12, 2);

            // Medio de pago
            $table->enum('medio_pago', [
                'Transferencia',
                'Efectivo'
            ]);

            // Observaciones
            $table->text('observaciones')->nullable();

            // Usuario que registra
            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ingresos');
    }
};
