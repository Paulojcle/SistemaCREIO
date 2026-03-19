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
        Schema::create('alunos', function (Blueprint $table) {
            $table->id();

            // Dados pessoais
            $table->string('nome', 100);
            $table->date('data_nascimento');
            $table->char('sexo', 1); // 'M' ou 'F'
            $table->string('celular', 15)->nullable();
            $table->string('foto', 255)->nullable();

            // Endereço
            $table->string('endereco', 100)->nullable();
            $table->string('numero', 10)->nullable();
            $table->string('bairro', 50)->nullable();
            $table->string('cep', 11)->nullable();
            $table->string('cidade', 50)->nullable();
            $table->string('tel_residencial', 15)->nullable();

            // Escola
            $table->foreignId('escola_id')->nullable()->constrained('escolas')->onDelete('set null');
            $table->string('serie', 20)->nullable();
            $table->string('turno', 20)->nullable();

            // Filiação
            $table->string('filiacao1', 100)->nullable();
            $table->string('filiacao2', 100)->nullable();

            // Saúde
            $table->boolean('alergico_medicamento')->default(false);
            $table->text('alergico_medicamento_qual')->nullable();
            $table->boolean('alergico_alimento')->default(false);
            $table->text('alergico_alimento_qual')->nullable();
            $table->boolean('usa_medicacao')->default(false);
            $table->text('usa_medicacao_qual')->nullable();
            $table->text('profissionais_crianca')->nullable();

            // Responsável
            $table->string('resp_nome', 100)->nullable();
            $table->date('resp_data_nascimento')->nullable();
            $table->string('resp_rg', 20)->nullable();
            $table->string('resp_cpf', 14)->nullable();
            $table->string('resp_estado_civil', 20)->nullable();

            // Métricas
            $table->string('grau_suporte', 20)->nullable();
            $table->boolean('possui_laudo')->default(false);
            $table->foreignId('origem_encaminhamento_id')->nullable()->constrained('origens_encaminhamento')->onDelete('set null');
            $table->date('data_diagnostico')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alunos');
    }
};
