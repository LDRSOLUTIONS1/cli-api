<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoCliente extends Model
{
    protected $table = 'cli_tipos_clientes';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'descripcion',
        'fecha_registro',
        'estado'
    ];

    public function clientes()
    {
        return $this->hasMany(Cliente::class, 'tipo_cliente_id');
    }

    public function users()
    {
        return $this->belongsToMany(
            User::class,
            'cli_user_tipo_cliente',
            'tipo_cliente_id',
            'user_id'
        );
    }
}
