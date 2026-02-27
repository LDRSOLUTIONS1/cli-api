<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PuestosModel extends Model
{
    protected $table = 'cli_puestos';
    public $timestamps = false;

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

    public function contactos()
    {
        return $this->hasMany(ContactosModel::class, 'puesto_id');
    }
}
