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
        Schema::create('lista_espera_profissional', function(Blueprint $table){
            $table->foreignId('lista_espera_id')->constrained('listas_espera')->onDelete('cascade');
            $table->foreignId('profissional_id')->constrained('profissionais')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lista_espera_profissional');
    }
};
