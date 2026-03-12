<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cli_municipios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('estado_id')->constrained('cli_estados');
            $table->string('nombre');

            $table->timestamp('fecha_registro')->useCurrent();
            $table->tinyInteger('estado')
                ->default(2)
                ->comment('0=Eliminado, 1=Inactivo, 2=Activo');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cli_municipios');
    }
};
