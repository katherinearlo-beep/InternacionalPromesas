<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('accounting_movements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('accounting_entry_id')
                ->constrained('accounting_entries')
                ->onDelete('cascade');
            $table->string('cuenta'); // Código PUC
            $table->string('nombre_cuenta');
            $table->decimal('debito', 15, 2)->default(0);
            $table->decimal('credito', 15, 2)->default(0);
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounting_movements');
    }
};
