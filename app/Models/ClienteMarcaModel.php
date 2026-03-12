<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClienteMarcaModel extends Model
{
    protected $table = 'cli_clientes_marcas';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'distribuidor_id',
        'marca_id',
        'fecha_registro',
        'estado'
    ];

    public function cliente()
    {
        return $this->belongsTo(ClientesModel::class, 'distribuidor_id');
    }

    public function marca()
    {
        return $this->belongsTo(MarcasModel::class, 'marca_id');
    }
}
