<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('registros_atendimento', function (Blueprint $table) {
            $table->foreignId('profissional_id')
                  ->nullable()
                  ->constrained('profissionais')
                  ->nullOnDelete()
                  ->after('aluno_id');
        });
    }

    public function down(): void
    {
        Schema::table('registros_atendimento', function (Blueprint $table) {
            $table->dropForeignIdFor(\App\Models\Profissional::class);
            $table->dropColumn('profissional_id');
        });
    }
};
