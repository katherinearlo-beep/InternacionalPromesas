<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use League\Csv\Reader;
use App\Models\Puc;

class PucSeeder extends Seeder
{
    public function run(): void
    {
        // Ruta absoluta al archivo CSV
        $filePath = database_path('seeders/puc_colombia.csv');

        if (!file_exists($filePath)) {
            throw new \Exception("❌ El archivo PUC no se encuentra en: $filePath");
        }

        // Abrir CSV (versión compatible con league/csv < 9)
        $csv = Reader::createFromPath($filePath, 'r');
        $csv->setHeaderOffset(0); // Primera fila como encabezados

        foreach ($csv as $record) {
            Puc::create([
                'codigo' => trim($record['CODIGO']),
                'nombre' => trim($record['NOMBRE']),
            ]);
        }

        $this->command->info('✅ PUC importado correctamente.');
    }
}
