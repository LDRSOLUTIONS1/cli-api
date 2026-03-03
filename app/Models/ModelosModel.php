<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelosModel extends Model
{

    protected $table = 'cli_modelos';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'marca_id',
        'nombre',
        'fecha_registro',
        'estado',
    ];

    // Una marca tiene muchos clientes
    public function clientes()
    {
        return $this->belongsToMany(
            ClientesModel::class,
            'cli_distribuidor_modelos',
            'distribuidor_id',
            'modelo_id',
        );
    }
}
