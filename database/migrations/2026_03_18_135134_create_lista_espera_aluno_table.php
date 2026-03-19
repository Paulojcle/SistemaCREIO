<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lista_espera_aluno', function (Blueprint $table) {
            $table->foreignId('lista_espera_id')->constrained('listas_espera')->onDelete('cascade');
            $table->foreignId('aluno_id')->constrained('alunos')->onDelete('cascade');
            $table->date('data_entrada');
            $table->string('status',20)->default('aguardando');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lista_espera_aluno');
    }
};
