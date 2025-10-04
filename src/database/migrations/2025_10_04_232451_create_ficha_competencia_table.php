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
        Schema::create('ficha_competencia', function (Blueprint $table) {
            $table->id();

            // Relaciones
            $table->foreignId('ficha_id')->constrained('fichas')->onDelete('cascade');
            $table->foreignId('competencia_id')->constrained('competencias')->onDelete('cascade');

            // Campos propios
            $table->integer('orden')->default(1);
            $table->integer('horas_totales_competencia')->default(0);
            $table->integer('horas_ejecutadas')->default(0);
            $table->enum('estado', ['pendiente', 'en_proceso', 'finalizado'])->default('pendiente');
            $table->text('observaciones')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ficha_competencia');
    }
};
