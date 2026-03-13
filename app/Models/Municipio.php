<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    protected $table = 'cli_municipios';
    public $timestamps = false;

    protected $fillable = [
        'estado_id',
        'nombre',
        'fecha_registro',
        'estado'
    ];

    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estado_id');
    }
}
