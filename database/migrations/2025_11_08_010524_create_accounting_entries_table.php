<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('accounting_entries', function (Blueprint $table) {
            $table->id();
            $table->string('tipo'); // RC, FC, FV, etc.
            $table->string('documento')->nullable(); // documento asignado
            $table->integer('numero'); // número automático
            $table->date('fecha');
            $table->text('observaciones')->nullable();
            $table->decimal('total_debito', 15, 2)->default(0);
            $table->decimal('total_credito', 15, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounting_entries');
    }
};
