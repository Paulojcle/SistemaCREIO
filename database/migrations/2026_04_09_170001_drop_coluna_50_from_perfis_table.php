<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('perfis', function (Blueprint $table) {
            $table->dropColumn('50');
        });
    }

    public function down(): void
    {
        //
    }
};
