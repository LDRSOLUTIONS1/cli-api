<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    protected $table = 'cli_paises';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'codigo_iso',
        'fecha_registro',
        'estado'
    ];

    public function estados()
    {
        return $this->hasMany(Estado::class, 'pais_id');
    }
}
