<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cli_contactos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('distribuidor_id')->nullable()->constrained('cli_clientes');
            $table->foreignId('puesto_id')->nullable()->constrained('cli_puestos');

            $table->string('nombre', 150);
            $table->string('correo', 150)->nullable();
            $table->string('extension', 20)->nullable();
            $table->string('telefono', 20)->nullable();
            $table->enum('estatus', ['Activo', 'ND', 'Inactivo'])->default('Activo');

            $table->timestamp('fecha_registro')->useCurrent();
            $table->tinyInteger('estado')
                ->default(2)
                ->comment('0=Eliminado, 1=Inactivo, 2=Activo');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cli_contactos');
    }
};
