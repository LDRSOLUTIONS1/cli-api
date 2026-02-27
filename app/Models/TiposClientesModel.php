<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TiposClientesModel extends Model
{
    protected $table = 'cli_tipos_cliente';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'nombre',
        'descripcion',
        'fecha_registro',
        'estado',
    ];

    public function clientes()
    {
        return $this->hasMany(ClientesModel::class, 'tipo_cliente_id');
    }
}
