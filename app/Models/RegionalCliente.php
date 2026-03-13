<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegionalCliente extends Model
{
    protected $table = 'cli_regional_cliente';
    public $timestamps = false;

    protected $fillable = [
        'regional_id',
        'distribuidor_id',
        'fecha_registro',
        'estado'
    ];
}
