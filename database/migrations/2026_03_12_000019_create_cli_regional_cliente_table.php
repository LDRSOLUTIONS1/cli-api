<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('cli_regional_cliente', function (Blueprint $table) {
            $table->id();

            $table->foreignId('regional_id')->constrained('cli_regionales');

            $table->foreignId('distribuidor_id')->constrained('cli_clientes');

            $table->timestamp('fecha_registro')->useCurrent();
            $table->tinyInteger('estado')
                ->default(2)
                ->comment('0=Eliminado, 1=Inactivo, 2=Activo');
        });
    }

    public function down()
    {
        Schema::dropIfExists('cli_regional_cliente');
    }
};
