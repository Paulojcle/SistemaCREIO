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
        Schema::table('perfil_user', function (Blueprint $table) {
            $table->dropForeign(['perfil_id']);
            $table->foreign('perfil_id')->references('id')->on('perfis')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('perfil_user', function (Blueprint $table) {
            $table->dropForeign(['perfil_id']);
            $table->foreign('perfil_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
};
