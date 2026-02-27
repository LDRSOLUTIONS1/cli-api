<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegimenesFiscalesModel extends Model
{
    protected $table = 'cli_regimenes_fiscales';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'c_regimen_fiscal',
        'descripcion',
        'persona_fisica',
        'persona_moral',
        'fecha_registro',
        'estado',
    ];
}
