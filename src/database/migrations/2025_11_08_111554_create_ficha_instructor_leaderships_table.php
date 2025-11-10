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
        Schema::create('ficha_instructor_leaderships', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ficha_id')
                ->constrained('fichas')
                ->cascadeOnDelete();
            $table->foreignId('instructor_id')
                ->constrained('instructors')
                ->cascadeOnDelete();

            $table->date('start_date');
            $table->date('end_date')->nullable();
                        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ficha_instructor_leaderships');
    }
};
