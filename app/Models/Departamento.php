<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    protected $table = 'cli_departamentos';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'descripcion',
        'fecha_registro',
        'estado'
    ];

    public function puestos()
    {
        return $this->hasMany(Puesto::class);
    }
}
