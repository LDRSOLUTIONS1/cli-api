<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    protected $table = 'cli_marcas';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'codigo',
        'fecha_registro',
        'estado'
    ];

    public function modelos()
    {
        return $this->hasMany(Modelo::class);
    }
}
