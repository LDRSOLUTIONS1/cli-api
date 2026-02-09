<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstadoModel extends Model
{
    protected $table = 'cli_estados';

    // Un estado pertenece a una región
    public function region()
    {
        return $this->belongsTo(RegionesModel::class, 'region_id');
    }
}
