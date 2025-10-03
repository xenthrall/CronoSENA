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
        Schema::create('programa_competencia', function (Blueprint $table) {
            $table->foreignId('programa_id')->constrained('programas')->onDelete('cascade');
            $table->foreignId('competencia_id')->constrained('competencias')->onDelete('cascade');

            $table->primary(['programa_id', 'competencia_id']);// Llave primaria compuesta
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programa_competencia');
    }
};
