<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClienteModelo extends Model
{
    protected $table = 'cli_clientes_modelos';
    public $timestamps = false;

    protected $fillable = [
        'distribuidor_id',
        'modelo_id',
        'fecha_registro',
        'estado'
    ];
}
