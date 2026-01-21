<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('estudiantes', function (Blueprint $table) {

            // ================= DATOS DEL DEPORTISTA =================
            $table->string('foto')->nullable()->after('documento');
            $table->enum('sexo', ['masculino', 'femenino', 'sin_definir'])->nullable();
            $table->integer('edad')->nullable();
            $table->string('talla_uniforme')->nullable();

            $table->boolean('otro_club')->default(false);
            $table->string('nombre_otro_club')->nullable();

            $table->string('categoria')->nullable();

            $table->enum('modalidad_contrato', [
                'mensual',
                'becado_50',
                'becado_100'
            ])->nullable();

            $table->enum('sede', [
                'itagui',
                'envigado',
                'medellin',
                'administrativa'
            ])->nullable();

            $table->decimal('precio_mensualidad', 10, 2)->nullable();

            // ================= PADRES (CIUDAD Y DEPTO) =================
            $table->string('direccion_padre')->nullable();
            $table->string('departamento_padre')->nullable();
            $table->string('ciudad_padre')->nullable();

            $table->string('direccion_madre')->nullable();
            $table->string('departamento_madre')->nullable();
            $table->string('ciudad_madre')->nullable();

            // ================= CAMPOS MÉDICOS =================
            $table->enum('sistema_salud', [
                'contributivo',
                'subsidiado',
                'ninguno'
            ])->nullable();

            $table->string('nombre_eps')->nullable();

            $table->boolean('medicina_prepagada')->default(false);
            $table->string('entidad_medicina_prepagada')->nullable();

            $table->boolean('enfermedad_grave')->default(false);
            $table->boolean('enfermedad_respiratoria')->default(false);
            $table->boolean('apto_deporte')->default(true);

            $table->string('contacto_emergencia')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('estudiantes', function (Blueprint $table) {
            $table->dropColumn([
                'foto',
                'sexo',
                'edad',
                'peso',
                'altura',
                'talla_uniforme',
                'otro_club',
                'nombre_otro_club',
                'categoria',
                'modalidad_contrato',
                'sede',
                'precio_mensualidad',
                'ciudad_padre',
                'departamento_padre',
                'ciudad_madre',
                'departamento_madre',
                'sistema_salud',
                'nombre_eps',
                'medicina_prepagada',
                'entidad_medicina_prepagada',
                'enfermedad_grave',
                'enfermedad_respiratoria',
                'apto_deporte',
                'contacto_emergencia',
            ]);
        });
    }
};
