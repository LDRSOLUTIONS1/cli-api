<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegionalesModel extends Model
{
    protected $table = 'cli_regionales';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'correo_electronico',
        'telefono',
        'fecha_registro',
        'estado',
    ];

    // Una regional tiene muchos clientes
    public function clientes()
    {
        return $this->belongsToMany(
            ClientesModel::class,
            'cli_regional_distribuidor',
            'regional_id',
            'distribuidor_id'
        );
    }
}
