<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contacto;
use Illuminate\Support\Facades\Log;

class ContactosSeeder extends Seeder
{
    public function run(): void
    {
        $csvPath = database_path('seeders/data/contactos.csv');

        if (!file_exists($csvPath)) {
            throw new \Exception(
                'No se encontró el archivo CSV en: ' . $csvPath
            );
        }

        $file = fopen($csvPath, 'r');

        if (!$file) {
            throw new \Exception(
                'No fue posible abrir el archivo CSV.'
            );
        }

        $headers = array_map('trim', fgetcsv($file));

        $requiredHeaders = [
            'distribuidor_id',
            'puesto_id',
            'nombre',
            'correo',
            'telefono'
        ];

        if ($headers !== $requiredHeaders) {
            fclose($file);

            throw new \Exception(
                'Los encabezados del CSV no coinciden. Se esperaba: '
                    . implode(', ', $requiredHeaders)
                    . ' | Encontrados: '
                    . implode(', ', $headers)
            );
        }

        $line = 1;
        $insertados = 0;
        $errores = 0;

        while (($row = fgetcsv($file)) !== false) {

            $line++;

            try {

                if (count($row) !== count($headers)) {

                    Log::error("Fila {$line} inválida: número de columnas incorrecto.", [
                        'columnas_esperadas' => count($headers),
                        'columnas_recibidas' => count($row),
                        'data' => $row
                    ]);

                    $errores++;
                    continue;
                }

                $record = array_combine($headers, $row);

                Contacto::create([
                    'distribuidor_id' => $this->normalizeValue($record['distribuidor_id']),
                    'puesto_id'       => $this->normalizeValue($record['puesto_id']),
                    'nombre'          => $this->normalizeValue($record['nombre']),
                    'correo'          => $this->normalizeValue($record['correo']),
                    'telefono'        => $this->normalizeValue($record['telefono']),
                    'estatus'         => 'Activo',
                    'estado'          => 2,
                ]);

                $insertados++;
            } catch (\Exception $e) {

                Log::error("Error al procesar la fila {$line}", [
                    'error' => $e->getMessage(),
                    'fila' => $row
                ]);

                $errores++;
            }
        }

        fclose($file);

        $this->command->info("Registros insertados: {$insertados}");
        $this->command->warn("Registros con error: {$errores}");
    }

    private function normalizeValue($value)
    {
        if ($value === null) {
            return null;
        }

        $value = trim($value);

        if (
            $value === '' ||
            strtolower($value) === 'null'
        ) {
            return null;
        }

        return $value;
    }
}
