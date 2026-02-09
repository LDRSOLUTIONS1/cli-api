<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DireccionesFiscalesModel extends Model
{
    protected $table = 'cli_distribuidor_direcciones_fiscales';

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
