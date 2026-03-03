<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactosModel extends Model
{
    protected $table = 'cli_contactos';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'distribuidor_id',
        'puesto_id',
        'nombre',
        'correo',
        'extension',
        'telefono',
        'estatus',
        'fecha_registro',
        'estado',
    ];

    // Un contacto pertenece a un distribuidor
    public function distribuidor()
    {
        return $this->belongsTo(ClientesModel::class, 'distribuidor_id');
    }

    // Una contacto pertenece a un puesto
    public function puesto()
    {
        return $this->belongsTo(PuestosModel::class, 'puesto_id');
    }

    // Un contacto pertenece a un distribuidor
    public function clientes()
    {
        return $this->belongsTo(ClientesModel::class, 'distribuidor_id');
    }
}
