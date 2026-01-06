<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{

    public function up(): void
    {
        DB::statement("
            ALTER TABLE ingresos
            MODIFY medio_pago ENUM(
                'Transferencia',
                'Cuenta Anterior 2025',
                'Efectivo'
            ) NOT NULL
        ");
    }

    public function down(): void
    {
        DB::statement("
            ALTER TABLE ingresos
            MODIFY medio_pago ENUM(
                'Transferencia',
                'Efectivo'
            ) NOT NULL
        ");
    }
};
