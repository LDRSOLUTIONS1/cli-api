<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
    protected $table = 'cli_modelos';
    public $timestamps = false;

    protected $fillable = [
        'marca_id',
        'nombre',
        'fecha_registro',
        'estado'
    ];

    public function clientes()
    {
        return $this->belongsToMany(
            Cliente::class,
            'cli_clientes_modelos',
            'modelo_id',
            'distribuidor_id'
        );
    }

    public function marca()
    {
        return $this->belongsTo(ClienteMarca::class);
    }
}
