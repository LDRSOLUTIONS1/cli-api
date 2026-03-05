<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaisModel extends Model
{
    protected $table = 'cli_paises';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'nombre',
        'codigo_iso',
        'fecha_registro',
        'estado',
    ];

    // Un país tiene muchos estados
    public function estados()
    {
        return $this->hasMany(EstadoModel::class, 'pais_id');
    }
}
