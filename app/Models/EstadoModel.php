<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstadoModel extends Model
{
    protected $table = 'cli_estados';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'pais_id',
        'region_id',
        'nombre',
        'abreviatura',
        'fecha_registro',
        'estado',
    ];

    // Un estado pertenece a un país
    public function pais()
    {
        return $this->belongsTo(PaisModel::class, 'pais_id');
    }

    // Un estado tiene muchos municipios
    public function municipios()
    {
        return $this->hasMany(MunicipioModel::class, 'estado_id');
    }

    // Un estado pertenece a una región
    public function region()
    {
        return $this->belongsTo(RegionesModel::class, 'region_id');
    }
}
