<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MarcasModel extends Model
{
    protected $table = 'cli_marcas';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'codigo',
        'fecha_registro',
        'estado',
    ];

    // Una marca tiene muchos clientes
    public function clientes()
    {
        return $this->belongsToMany(
            ClientesModel::class,
            'cli_distribuidor_marcas',
            'distribuidor_id',
            'marca_id',
        );
    }
}
