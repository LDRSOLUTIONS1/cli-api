<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClienteDireccion extends Model
{
    protected $table = 'cli_clientes_direcciones';
    public $timestamps = false;

    protected $fillable = [
        'distribuidor_id',
        'tipo',
        'calle',
        'numero_ext',
        'numero_int',
        'colonia',
        'codigo_postal',
        'pais_id',
        'estado_id',
        'municipio_id',
        'latitud',
        'longitud',
        'fecha_registro',
        'estado'
    ];

    public function distribuidor()
    {
        return $this->belongsTo(Cliente::class, 'distribuidor_id');
    }

    // Una direcion pertenece a un país
    public function pais()
    {
        return $this->belongsTo(Pais::class, 'pais_id');
    }

    // Una direcion pertenece a un estado
    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estado_id');
    }

    // Una direcion pertenece a un municipio
    public function municipio()
    {
        return $this->belongsTo(Municipio::class, 'municipio_id');
    }
}
