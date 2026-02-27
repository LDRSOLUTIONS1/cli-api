<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DireccionesModel extends Model
{
    protected $table = 'cli_distribuidor_direcciones';
    public $timestamps = false;

    protected $fillable = [
        'id',
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
        'estado',
    ];

    public function distribuidor()
    {
        return $this->belongsTo(ClientesModel::class, 'distribuidor_id');
    }

    // Una direcion perteenece a un país
    public function pais()
    {
        return $this->belongsTo(PaisModel::class, 'pais_id');
    }

    // Una direcion perteenece a un estado
    public function estado()
    {
        return $this->belongsTo(EstadoModel::class, 'estado_id');
    }

    // Una direcion perteenece a un municipio
    public function municipio()
    {
        return $this->belongsTo(MunicipioModel::class, 'municipio_id');
    }
}
