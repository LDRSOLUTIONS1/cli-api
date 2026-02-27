<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartamentosModel extends Model
{
    protected $table = 'cli_departamentos';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'nombre',
        'descripcion',
        'fecha_registro',
        'estado',
    ];

    public function puestos()
    {
        return $this->hasMany(PuestosModel::class, 'departamento_id');
    }
}
