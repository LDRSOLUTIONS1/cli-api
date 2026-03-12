<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cli_puestos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('departamento_id')->nullable()->constrained('cli_departamentos');
            $table->string('nombre', 150);
            $table->text('descripcion')->nullable();

            $table->timestamp('fecha_registro')->useCurrent();
            $table->tinyInteger('estado')
                ->default(2)
                ->comment('0=Eliminado, 1=Inactivo, 2=Activo');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cli_puestos');
    }
};
