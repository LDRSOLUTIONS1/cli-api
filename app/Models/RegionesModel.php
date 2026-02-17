<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegionesModel extends Model
{
    protected $table = 'cli_regiones';

    protected $fillable = [
        'id',
        'nombre',
        'descripcion',
        'fecha_registro',
        'estado',
    ];
}
