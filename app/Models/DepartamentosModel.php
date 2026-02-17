<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartamentosModel extends Model
{
    use HasFactory;

    protected $table = 'cli_departamentos';

    protected $fillable = [
        'id',
        'nombre',
        'descripcion',
        'fecha_registro',
        'estado',
    ];
}
