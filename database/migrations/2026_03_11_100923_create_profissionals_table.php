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
        Schema::create('profissionais', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->date('data_nascimento');
            $table->string('rg', 20)->nullable();
            $table->string('cpf', 14)->nullable()->unique();
            $table->string('celular', 20)->nullable();
            $table->string('numero_registro', 30)->nullable();
            $table->string('profissao')->nullable();
            $table->string('especializacao')->nullable();
            $table->timestamps();
        });

        Schema::create('profissional_formacoes', function (Blueprint $table){
            $table->id();
            $table->foreignId('profissional_id')->constrained('profissionais')->onDelete('cascade'); // era profissionais_id
            $table->string('descricao');
            $table->timestamps();
        });
        
        Schema::create('profissional_documentos', function(Blueprint $table){
            $table->id();
            $table->foreignId('profissional_id')->constrained('profissionais')->onDelete('cascade');
            $table->string('nome_original');
            $table->string('arquivo');       // estava faltando
            $table->string('tipo_mime')->nullable(); // era descricao
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profissional_documentos');
        Schema::dropIfExists('profissional_formacoes');
        Schema::dropIfExists('profissionais');
    }
};
