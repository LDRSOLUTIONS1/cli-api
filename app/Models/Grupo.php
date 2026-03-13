<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    protected $table = 'cli_grupos';
    public $timestamps = false;

    protected $fillable = [
        'codigo',
        'nombre',
        'descripcion',
        'fecha_registro',
        'estado'
    ];

    public function clientes()
    {
        return $this->hasMany(Cliente::class, 'grupo_id');
    }
}
