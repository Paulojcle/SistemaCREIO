<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('documentos_atendimento', function (Blueprint $table) {
            $table->id();
            $table->foreignId('registro_atendimento_id')
                  ->constrained('registros_atendimento')
                  ->cascadeOnDelete();
            $table->string('nome_original');
            $table->string('arquivo');
            $table->string('tipo_mime');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('documentos_atendimento');
    }
};
