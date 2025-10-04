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
            $table->string('codigo_programa')->unique();
            $table->string('nombre');
            $table->integer('duracion_total_horas');

            $table->string('version')->default('1')->nullable();

            $table->foreignId('nivel_formacion_id')
                ->nullable()
                ->constrained('niveles_formacion')
                ->nullOnDelete();

            $table->foreignId('nombre_programa_especial_id')
                ->nullable()
                ->constrained('nombre_programa_especial')
                ->nullOnDelete();

            $table->timestamps();
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
