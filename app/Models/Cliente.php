<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class Cliente extends Model
{
    protected $table = 'cli_clientes';
    public $timestamps = false;

    protected $fillable = [
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
        'estado'
    ];

    // Una sucursal pertenece a una matriz
    public function matriz()
    {
        return $this->belongsTo(Cliente::class, 'matriz_id');
    }

    // Una matriz tiene muchas sucursales
    public function sucursales()
    {
        return $this->hasMany(Cliente::class, 'matriz_id');
    }

    public function distribuidor()
    {
        return $this->belongsTo(Cliente::class, 'distribuidor_id');
    }

    // Un cliente pertenece a un regimen fiscal
    public function regimenFiscal()
    {
        return $this->belongsTo(RegimenFiscal::class, 'regimen_fiscal_id');
    }

    // Un cliente pertenece a un grupo
    public function grupo()
    {
        return $this->belongsTo(Grupo::class, 'grupo_id');
    }

    // Un cliente pertenece a un tipo de cliente
    public function tipoCliente()
    {
        return $this->belongsTo(TipoCliente::class, 'tipo_cliente_id');
    }

    // Un cliente tiene muchas direcciones
    public function direcciones()
    {
        return $this->hasMany(ClienteDireccion::class, 'distribuidor_id');
    }

    // Un cliente tiene muchas direcciones fiscales
    public function direccionesFiscales()
    {
        return $this->hasMany(ClienteDireccionFiscal::class, 'distribuidor_id');
    }

    // Un cliente tiene muchos contactos
    public function contactos()
    {
        return $this->hasMany(Contacto::class, 'distribuidor_id');
    }

    // Un cliente tiene muchos regionales
    public function regionales()
    {
        return $this->belongsToMany(
            Regional::class,
            'cli_regional_cliente',
            'distribuidor_id',
            'regional_id'
        )->select(
            'cli_regionales.id',
            'cli_regionales.nombre',
            'cli_regionales.apellido_paterno',
            'cli_regionales.apellido_materno'
        );
    }

    // Un cliente tiene muchos modelos
    public function modelos()
    {
        return $this->belongsToMany(
            Modelo::class,
            'cli_clientes_modelos',
            'distribuidor_id',
            'modelo_id',
        )->select(
            'cli_modelos.id',
            'cli_modelos.nombre',
        );
    }

    // Un cliente tiene muchas marcas
    public function marcas()
    {
        return $this->belongsToMany(
            Marca::class,
            'cli_clientes_marcas',
            'distribuidor_id',
            'marca_id',
        );
    }

    public function scopeVisibleParaUsuario(Builder $query)
    {
        $user = Auth::user();

        // Si el usuario es SUPER_ADMIN y ADMINISTRADOR, se muestran toda la información
        if ($user->rolid == User::SUPER_ADMIN || $user->rolid == User::ADMINISTRADOR || $user->rolid == User::CONSULTOR) {
            return $query;
        }

        $tipos = $user->tiposCliente()->pluck('tipo_cliente_id');

        return $query->whereIn('tipo_cliente_id', $tipos);
    }
}
