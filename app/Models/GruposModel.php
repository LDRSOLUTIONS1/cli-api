<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GruposModel extends Model
{
    protected $table = 'cli_grupos';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'codigo',
        'nombre',
        'descripcion',
        'fecha_registro',
        'estado',
    ];

    public function clientes()
    {
        return $this->hasMany(ClientesModel::class, 'grupo_id');
    }
}
