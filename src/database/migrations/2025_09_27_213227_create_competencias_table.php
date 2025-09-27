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
        Schema::create('competencias', function (Blueprint $table) {
            $table->id();

            // Relación con tipos_competencia
            $table->foreignId('tipo_competencia_id')
                ->constrained('tipos_competencia')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->string('codigo_norma', 50)->unique(); // Código identificador de la norma
            $table->string('nombre', 255);               // Nombre de la competencia
            $table->text('descripcion_norma')->nullable(); //  norma / unidad competencia
            $table->integer('duracion_horas')->unsigned(); // Número de horas
            $table->string('version')->default('1');   // Versión de la norma

            $table->timestamps(); // created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('competencias');
    }
};
