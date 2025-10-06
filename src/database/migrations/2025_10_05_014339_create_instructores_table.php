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
        Schema::create('instructores', function (Blueprint $table) {
            $table->id();
            $table->string('documento')->unique();
            $table->string('tipo_documento')->nullable();
            $table->string('nombre_completo')->nullable();
            $table->string('nombre')->nullable();
            $table->string('apellido')->nullable();
            $table->string('correo')->unique();
            $table->string('telefono')->nullable();

            // Relaciones
            $table->foreignId('equipo_ejecutor_id')
                ->nullable()
                ->constrained('equipo_ejecutores')
                ->cascadeOnUpdate()
                ->nullOnDelete();

            /*$table->foreignId('profesion_id')
                ->constrained('profesiones')
                ->cascadeOnUpdate()
                ->nullOnDelete();
            */

            $table->string('especialidad')->nullable();
            $table->string('foto_url')->nullable();
            $table->boolean('activo')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instructores');
    }
};
