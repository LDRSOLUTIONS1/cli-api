<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClienteMarca extends Model
{
    protected $table = 'cli_clientes_marcas';
    public $timestamps = false;

    protected $fillable = [
        'distribuidor_id',
        'marca_id',
        'fecha_registro',
        'estado'
    ];
}
