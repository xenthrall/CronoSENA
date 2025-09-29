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
        Schema::create('programas', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_programa');
            $table->string('nombre');
            $table->string('duracion_total_horas');
            $table->timestamps();

            $table->foreignId('nivel_formacion_id')->constrained('niveles_formacion')->onDelete('cascade');
            $table->foreignId('nombre_programa_especial_id')->constrained('nombre_programa_especial')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programas');
    }
};
