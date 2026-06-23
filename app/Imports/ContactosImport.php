<?php

namespace App\Imports;

use App\Models\Contacto;
use App\Models\Cliente;
use App\Models\Puesto;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;

class ContactosImport implements ToCollection, WithHeadingRow, SkipsOnError
{
    use SkipsErrors;

    private array $errores = [];
    private int $actualizados = 0;
    private int $creados = 0;

    public function collection(Collection $rows)
    {
        foreach ($rows as $index => $row) {

            $fila = $index + 2;

            $id = $row['id'] ?? null;
            $clienteId = $row['cliente_id'] ?? null;
            $puestoId = $row['puesto_id'] ?? null;

            $nombre = trim($row['nombre'] ?? '');

            if (empty($nombre)) {
                $this->errores[] =
                    "Fila {$fila}: El nombre es obligatorio.";
                continue;
            }

            if (!$clienteId) {
                $this->errores[] =
                    "Fila {$fila}: CLIENTE_ID es obligatorio.";
                continue;
            }

            $cliente = Cliente::find($clienteId);

            if (!$cliente) {
                $this->errores[] =
                    "Fila {$fila}: El cliente {$clienteId} no existe.";
                continue;
            }

            if (!$puestoId) {
                $this->errores[] =
                    "Fila {$fila}: PUESTO_ID es obligatorio.";
                continue;
            }

            $puesto = Puesto::find($puestoId);

            if (!$puesto) {
                $this->errores[] =
                    "Fila {$fila}: El puesto {$puestoId} no existe.";
                continue;
            }

            $correo = null;

            if (
                !empty($row['correo']) &&
                trim($row['correo']) !== '—'
            ) {
                $correo = trim($row['correo']);
            }

            $telefono = null;

            if (
                !empty($row['telefono']) &&
                trim($row['telefono']) !== '—'
            ) {
                $telefono = trim($row['telefono']);
            }

            $estadoTexto = strtolower(trim($row['estatus'] ?? ''));

            $estado = match ($estadoTexto) {
                'activo' => 2,
                'inactivo' => 1,
                default => 2,
            };

            $contacto = null;

            if (!empty($id)) {
                $contacto = Contacto::where('id', $id)
                    ->where('estado', '!=', 0)
                    ->first();
            }

            if ($contacto) {

                $contacto->update([
                    'distribuidor_id' => $clienteId,
                    'puesto_id' => $puestoId,
                    'nombre' => $nombre,
                    'correo' => $correo,
                    'telefono' => $telefono,
                    'estado' => $estado,
                ]);

                $this->actualizados++;
            } else {

                Contacto::create([
                    'distribuidor_id' => $clienteId,
                    'puesto_id' => $puestoId,
                    'nombre' => $nombre,
                    'correo' => $correo,
                    'telefono' => $telefono,
                    'estado' => $estado,
                    'fecha_registro' => now(),
                ]);

                $this->creados++;
            }
        }
    }

    public function getErrores(): array
    {
        return $this->errores;
    }

    public function getActualizados(): int
    {
        return $this->actualizados;
    }

    public function getCreados(): int
    {
        return $this->creados;
    }
}
