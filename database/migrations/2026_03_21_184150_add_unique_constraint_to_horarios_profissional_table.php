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
        Schema::table('horarios_profissional', function (Blueprint $table) {
            $table->unique(['profissional_id', 'dia_semana', 'hora_inicio'], 'horario_unico_profissional');
        });
    }

    public function down(): void
    {
        Schema::table('horarios_profissional', function (Blueprint $table) {
            $table->dropUnique('horario_unico_profissional');
        });
    }
};
