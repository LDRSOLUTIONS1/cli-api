<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('cli_users', function (Blueprint $table) {
            $table->id();
            $table->string('numcolaborador');
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('telefono')->nullable();
            $table->string('email_user')->unique();
            $table->string('password');
            $table->tinyInteger('rolid');
            $table->rememberToken();

            $table->timestamp('fecha_registro')->useCurrent();
            $table->tinyInteger('estado')
                ->default(2)
                ->comment('0=Eliminado, 1=Inactivo, 2=Activo');
        });
    }

    public function down()
    {
        Schema::dropIfExists('cli_users');
    }
};
