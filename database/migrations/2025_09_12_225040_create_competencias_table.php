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
            $table->id(); // Identificador único
            $table->foreignId('tipo_competencia_id')
                ->nullable()
                ->constrained('tipos_competencia')
                ->onDelete('set null');

            $table->string('codigo_norma', 20)->unique(); // Código de norma (ej: 220601501)
            $table->string('nombre', 255); // Nombre de la competencia
            $table->text('descripcion_norma'); // Texto de la norma/unidad de competencia
            $table->integer('duracion_horas'); // Duración máxima estimada
            $table->integer('version')->default(1); // Control de actualizaciones
            $table->boolean('estado')->default(true); // true = Activo, false = Inactivo
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
