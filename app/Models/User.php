<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'cli_users';
    public $timestamps = false;

    const SUPER_ADMIN = 1;
    const ADMINISTRADOR = 2;
    const INTERNO_USER = 3;
    const EXTERNO_USER = 4;
    const GUBERNAMENTAL_USER = 5;
    const DISTRIBUIDOR_USER = 6;
    const CONSULTOR = 7;    

    protected $fillable = [
        'numcolaborador',
        'nombres',
        'apellidos',
        'telefono',
        'email_user',
        'password',
        'rolid',
        'remember_token',
        'fecha_registro',
        'estado',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function tiposCliente()
    {
        return $this->belongsToMany(
            TipoCliente::class,
            'cli_user_tipo_cliente',
            'user_id',
            'tipo_cliente_id'
        );
    }
}
