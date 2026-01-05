<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('estudiantes', function (Blueprint $table) {
            $table->id();

            // Datos del estudiante
            $table->string('documento')->unique();
            $table->string('nombre_completo');
            $table->string('telefono')->nullable();
            $table->string('direccion')->nullable();
            $table->date('fecha_nacimiento');
            $table->string('ciudad_nacimiento');
            $table->string('departamento_nacimiento');
            $table->date('fecha_ingreso');

            // Padre
            $table->string('nombre_padre')->nullable();
            $table->string('documento_padre')->nullable();
            $table->string('telefono_padre')->nullable();
            $table->string('correo_padre')->nullable();

            // Madre
            $table->string('nombre_madre')->nullable();
            $table->string('documento_madre')->nullable();
            $table->string('telefono_madre')->nullable();
            $table->string('correo_madre')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('estudiantes');
    }
};
