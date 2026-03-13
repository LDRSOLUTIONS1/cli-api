<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $table = 'cli_estados';
    public $timestamps = false;

    protected $fillable = [
        'pais_id',
        'region_id',
        'nombre',
        'abreviatura',
        'fecha_registro',
        'estado'
    ];

    public function pais()
    {
        return $this->belongsTo(Pais::class, 'pais_id');
    }

    public function municipios()
    {
        return $this->hasMany(Municipio::class, 'estado_id');
    }

    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id');
    }
}
