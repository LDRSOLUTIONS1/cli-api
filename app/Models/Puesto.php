<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Puesto extends Model
{
    protected $table = 'cli_puestos';
    public $timestamps = false;

    protected $fillable = [
        'departamento_id',
        'nombre',
        'descripcion',
        'fecha_registro',
        'estado'
    ];

    public function departamento()
    {
        return $this->belongsTo(Departamento::class);
    }
}
