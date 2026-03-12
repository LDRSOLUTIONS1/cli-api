<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cli_regimenes_fiscales', function (Blueprint $table) {
            $table->id();
            $table->string('c_regimen_fiscal', 10);
            $table->string('descripcion');
            $table->string('persona_fisica');
            $table->string('persona_moral');

            $table->timestamp('fecha_registro')->useCurrent();
            $table->tinyInteger('estado')
                ->default(2)
                ->comment('0=Eliminado, 1=Inactivo, 2=Activo');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cli_regimenes_fiscales');
    }
};
