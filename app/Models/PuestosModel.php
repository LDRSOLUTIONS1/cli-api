<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PuestosModel extends Model
{
    use HasFactory;

    protected $table = 'cli_puestos';

    protected $fillable = [
        'id',
        'departamento_id',
        'nombre',
        'descripcion',
        'fecha_registro',
        'estado',
    ];

    //Un puesto tiene un departamento
    public function departamento()
    {
        return $this->belongsTo(DepartamentosModel::class, 'departamento_id');
    }
}
