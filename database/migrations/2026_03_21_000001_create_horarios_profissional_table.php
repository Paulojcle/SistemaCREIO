<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('horarios_profissional', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profissional_id')->constrained('profissionais')->onDelete('cascade');
            $table->tinyInteger('dia_semana'); // 0=Domingo, 1=Segunda, ..., 6=Sábado
            $table->time('hora_inicio');
            $table->unsignedInteger('duracao_minutos');
            $table->boolean('ativo')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('horarios_profissional');
    }
};
