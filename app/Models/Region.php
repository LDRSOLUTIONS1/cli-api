<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $table = 'cli_regiones';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'descripcion',
        'fecha_registro',
        'estado'
    ];

    public function estados()
    {
        return $this->hasMany(Estado::class);
    }
}
