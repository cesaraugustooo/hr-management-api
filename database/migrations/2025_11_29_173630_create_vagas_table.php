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
        Schema::create('vagas', function (Blueprint $table) {
            $table->id();
            $table->string('titulo',255);
            $table->longText('descricao');
            $table->string('localizacao');
            $table->boolean('remoto');
            $table->string('tipo_contrato');
            $table->float('salario_min');
            $table->float('salario_max');
            $table->string('nivel_experiencia');
            $table->text('requisitos');
            $table->text('diferenciais');
            $table->float('carga_horaria_semanal');
            $table->text('beneficios')->nullable();
            $table->enum('status',['Aberta','Pausada','Cancelada','Preenchida']);
            $table->foreignId('empresas_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vagas');
    }
};
