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
        Schema::create('instructor_competencia', function (Blueprint $table) {
            $table->foreignId('instructor_id')->constrained('instructores')->onDelete('cascade');
            $table->foreignId('competencia_id')->constrained('competencias')->onDelete('cascade');
            
            $table->primary(['instructor_id', 'competencia_id']);// Llave primaria compuesta
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instructor_competencia');
    }
};
