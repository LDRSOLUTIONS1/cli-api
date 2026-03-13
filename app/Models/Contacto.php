<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    protected $table = 'cli_contactos';
    public $timestamps = false;

    protected $fillable = [
        'distribuidor_id',
        'puesto_id',
        'nombre',
        'correo',
        'extension',
        'telefono',
        'estatus',
        'fecha_registro',
        'estado'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'distribuidor_id');
    }

    public function puesto()
    {
        return $this->belongsTo(Puesto::class);
    }
}
