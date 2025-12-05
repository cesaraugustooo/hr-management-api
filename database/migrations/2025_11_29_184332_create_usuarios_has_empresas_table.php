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
        Schema::create('usuarios_has_empresas', function (Blueprint $table) {
            $table->foreignId('users_id')->constrained()->cascadeOnDelete();
            $table->foreignId('empresas_id')->constrained()->cascadeOnDelete();
            $table->primary(['users_id','empresas_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios_has_empresas');
    }
};
