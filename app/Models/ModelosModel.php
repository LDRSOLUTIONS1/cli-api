<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelosModel extends Model
{

    protected $table = 'wms_linea_producto';
    protected $primaryKey = 'idlineaproducto';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'idlineaproducto',
        'cve_lenea_producto',
        'descripcion',
        'fecha_creacion',
        'estado',
        'marca_id',
    ];

    // Una marca tiene muchos clientes
    public function clientes()
    {
        return $this->belongsToMany(
            ClientesModel::class,
            'cli_distribuidor_modelos',
            'distribuidor_id',
            'id_modelo',
        );
    }
}
