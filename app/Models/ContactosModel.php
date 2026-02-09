<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactosModel extends Model
{
    protected $table = 'cli_contactos';

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
}
