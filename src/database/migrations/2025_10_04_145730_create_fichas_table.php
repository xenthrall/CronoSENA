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
        Schema::create('fichas', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique();

            // Fechas clave
            $table->date('fecha_inicio');
            $table->date('fecha_fin_lectiva')->nullable();
            $table->date('fecha_fin')->nullable();

            $table->foreignId('programa_id')
                ->nullable()
                ->constrained('programas')
                ->nullOnDelete();

            $table->foreignId('municipio_id')
                ->nullable()
                ->constrained('municipios')
                ->nullOnDelete();
            
             $table->foreignId('estado_id')
                ->nullable()
                ->constrained('estados_ficha')
                ->nullOnDelete();

            $table->foreignId('jornada_id')
                ->nullable()
                ->constrained('jornadas')
                ->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fichas');
    }
};
