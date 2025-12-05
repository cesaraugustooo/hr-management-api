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
        Schema::create('candidaturas', function (Blueprint $table) {
            $table->id();
            $table->string('name',255);
            $table->string('contact_email',255);
            $table->string('telefone',50);
            $table->enum('status',['Pendente','Em analise','Aprovado', 'Reprovado']);
            $table->foreignId('vagas_id')->constrained();
            $table->foreignId('users_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidaturas');
    }
};
