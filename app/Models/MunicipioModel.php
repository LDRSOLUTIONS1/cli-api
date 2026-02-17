<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MunicipioModel extends Model
{
    protected $table = 'cli_municipios';

    protected $fillable = [
        'id',
        'estado_id',
        'nombre',
        'fecha_registro',
        'estado',
    ];
}
