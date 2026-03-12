<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cli_clientes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('grupo_id')->nullable()->constrained('cli_grupos');
            $table->foreignId('matriz_id')->nullable()->constrained('cli_clientes');
            $table->foreignId('tipo_cliente_id')->nullable()->constrained('cli_tipos_clientes');
            $table->foreignId('regimen_fiscal_id')->nullable()->constrained('cli_regimenes_fiscales');

            $table->string('tipo_persona', 20)->nullable();

            $table->string('nombre_fisica')->nullable();
            $table->string('apellido_paterno')->nullable();
            $table->string('apellido_materno')->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->string('correo')->nullable();
            $table->string('curp', 20)->nullable();

            $table->string('razon_social')->nullable();
            $table->string('representante_legal')->nullable();
            $table->string('domicilio_fiscal')->nullable();
            $table->string('rfc', 20)->nullable();

            $table->string('nombre_comercial')->nullable();
            $table->string('repve')->nullable();
            $table->string('plaza')->nullable();
            $table->string('clasificacion')->nullable();
            $table->string('estatus')->nullable();
            $table->string('tipo_negocio')->nullable();

            $table->string('telefono', 20)->nullable();
            $table->string('telefono_alt', 20)->nullable();

            $table->timestamp('fecha_registro')->useCurrent();
            $table->tinyInteger('estado')
                ->default(2)
                ->comment('0=Eliminado, 1=Inactivo, 2=Activo');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cli_clientes');
    }
};
