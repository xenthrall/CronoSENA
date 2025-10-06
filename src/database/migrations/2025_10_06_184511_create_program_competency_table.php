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
        Schema::create('program_competency', function (Blueprint $table) {

            $table->foreignId('program_id')
                ->constrained('programs')
                ->cascadeOnDelete();

            $table->foreignId('competency_id')
                ->constrained('competencies')
                ->cascadeOnDelete();

            $table->primary(['program_id', 'competency_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_competency');
    }
};
