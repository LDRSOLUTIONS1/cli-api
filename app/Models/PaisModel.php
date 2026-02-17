<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaisModel extends Model
{
    protected $table = 'cli_paises';

    protected $fillable = [
        'id',
        'nombre',
        'codigo_iso',
        'fecha_registro',
        'estado',
    ];
}
