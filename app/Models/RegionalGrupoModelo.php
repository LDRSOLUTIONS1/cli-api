<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegionalGrupoModelo extends Model
{
    protected $table = 'cli_regional_grupo';
    public $timestamps = false;

    protected $fillable = [
        'regional_id',
        'grupo_id',
        'fecha_registro',
        'estado'
    ];
}
