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
        Schema::create('ficha_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Ej: En formación, Finalizada, Cancelada
            $table->string('code')->unique(); // Ej: en_formacion, finalizada, cancelada
            $table->string('color')->nullable(); // Ej: success, danger, warning o #hex
            $table->integer('order')->default(0); // Orden lógico en interfaces
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ficha_statuses');
    }
};
