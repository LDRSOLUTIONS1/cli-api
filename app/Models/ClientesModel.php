<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientesModel extends Model
{
    protected $table = 'cli_distribuidores';

    protected $fillable = [
        'id',
        'grupo_id',
        'matriz_id',
        'tipo_cliente_id',
        'regimen_fiscal_id',
        'tipo_persona',
        'nombre_fisica',
        'apellido_paterno',
        'apellido_materno',
        'fecha_nacimiento',
        'correo',
        'curp',
        'razon_social',
        'representante_legal',
        'domicilio_fiscal',
        'rfc',
        'nombre_comercial',
        'repve',
        'plaza',
        'clasificacion',
        'estatus',
        'tipo_negocio',
        'telefono',
        'telefono_alt',
        'fecha_registro',
        'estado',
    ];

    // Una sucursal pertenece a una matriz
    public function matriz()
    {
        return $this->belongsTo(ClientesModel::class, 'matriz_id');
    }

    // Una matriz tiene muchas sucursales
    public function sucursales()
    {
        return $this->hasMany(ClientesModel::class, 'matriz_id');
    }

    // Un cliente pertenece a un regimen fiscal
    public function regimenFiscal()
    {
        return $this->belongsTo(RegimenesFiscalesModel::class, 'regimen_fiscal_id');
    }

    // Un cliente pertenece a un grupo
    public function grupo()
    {
        return $this->belongsTo(GruposModel::class, 'grupo_id');
    }

    // Un cliente pertenece a un tipo de cliente
    public function tipoCliente()
    {
        return $this->belongsTo(TiposClientesModel::class, 'tipo_cliente_id');
    }

    // Un cliente tiene muchas direcciones
    public function direcciones()
    {
        return $this->hasMany(DireccionesModel::class, 'distribuidor_id');
    }

    // Un cliente tiene muchas direcciones fiscales
    public function direccionesFiscales()
    {
        return $this->hasMany(DireccionesFiscalesModel::class, 'distribuidor_id');
    }

    // Un cliente tiene muchos contactos
    public function contactos()
    {
        return $this->hasMany(ContactosModel::class, 'distribuidor_id');
    }

    // Un cliente tiene muchos regionales
    public function regionales()
    {
        return $this->belongsToMany(
            RegionalesModel::class,
            'cli_regional_distribuidor',
            'regional_id',
            'distribuidor_id',
        );
    }

    // Un cliente tiene muchos modelos
    public function modelos()
    {
        return $this->belongsToMany(
            ModelosModel::class,
            'cli_distribuidor_modelos',
            'distribuidor_id',
            'id_modelo',
        );
    }

    // Un cliente tiene muchas marcas
    public function marcas()
    {
        return $this->belongsToMany(
            MarcasModel::class,
            'cli_distribuidor_marcas',
            'distribuidor_id',
            'marca_id',
        );
    }
}
