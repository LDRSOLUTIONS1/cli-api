<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('cli_documents', function (Blueprint $table) {
            $table->id();

            $table->foreignId('cliente_id')->constrained('cli_clientes');

            $table->enum('type', [
                'convocatoria',
                'bases',
                'anexos',
                'acta_junta_aclaraciones',
                'acta_presentacion_apertura_proposiciones',
                'acta_fallo',
                'contrato',
                'fianza',
                'acta_entrega',
                'facturas',
                'cancelacion_garantia',
                'otros'
            ]);

            $table->string('name')->nullable();
            $table->integer('current_version')->default(1);

            $table->tinyInteger('estado')
                ->default(2)
                ->comment('0=Eliminado, 1=Inactivo, 2=Activo');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cli_documents');
    }
};
