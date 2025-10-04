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
        Schema::create('estados_ficha', function (Blueprint $table) {
            $table->id();
            $table->string('nombre'); // Ej: En formación, Finalizada, Cancelada
            $table->string('codigo')->unique(); // Ej: en_formacion, finalizada, cancelada
            $table->string('color')->nullable(); // Ej: success, danger, warning o #hex
            $table->integer('orden')->default(0); // Orden lógico en interfaces
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estados_ficha');
    }
};
