<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cli_estados', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pais_id')->constrained('cli_paises');
            $table->foreignId('region_id')->constrained('cli_regiones');

            $table->string('nombre');
            $table->string('abreviatura', 10)->nullable();

            $table->timestamp('fecha_registro')->useCurrent();
            $table->tinyInteger('estado')
                ->default(2)
                ->comment('0=Eliminado, 1=Inactivo, 2=Activo');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cli_estados');
    }
};
