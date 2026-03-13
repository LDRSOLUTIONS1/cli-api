<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Regional extends Model
{
    protected $table = 'cli_regionales';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'correo_electronico',
        'telefono',
        'fecha_registro',
        'estado'
    ];

    public function clientes()
    {
        return $this->belongsToMany(Cliente::class, 'cli_regional_cliente', 'regional_id', 'distribuidor_id');
    }
}
