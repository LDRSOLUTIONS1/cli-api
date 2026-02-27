<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegionesModel extends Model
{
    protected $table = 'cli_regiones';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'nombre',
        'descripcion',
        'fecha_registro',
        'estado',
    ];
}
