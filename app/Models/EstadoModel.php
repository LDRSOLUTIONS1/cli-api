<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstadoModel extends Model
{
    protected $table = 'cli_estados';

    protected $fillable = [
        'id',
        'pais_id',
        'region_id',
        'nombre',
        'abreviatura',
        'fecha_registro',
        'estado',
    ];

    // Un estado pertenece a una región
    public function region()
    {
        return $this->belongsTo(RegionesModel::class, 'region_id');
    }
}
