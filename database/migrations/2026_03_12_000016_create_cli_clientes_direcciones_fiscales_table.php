<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cli_clientes_direcciones_fiscales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('distribuidor_id')->nullable()->constrained('cli_clientes');

            $table->enum('tipo', ['Fiscal'])->nullable();
            $table->string('calle', 150);
            $table->string('numero_ext', 20)->nullable();
            $table->string('numero_int', 20)->nullable();
            $table->string('colonia', 150)->nullable();
            $table->string('codigo_postal', 10)->nullable();

            $table->foreignId('pais_id')->nullable()->constrained('cli_paises');
            $table->foreignId('estado_id')->nullable()->constrained('cli_estados');
            $table->foreignId('municipio_id')->nullable()->constrained('cli_municipios');

            $table->decimal('latitud', 10, 7)->nullable();
            $table->decimal('longitud', 10, 7)->nullable();

            $table->timestamp('fecha_registro')->useCurrent();
            $table->tinyInteger('estado')
                ->default(2)
                ->comment('0=Eliminado, 1=Inactivo, 2=Activo');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cli_clientes_direcciones_fiscales');
    }
};
