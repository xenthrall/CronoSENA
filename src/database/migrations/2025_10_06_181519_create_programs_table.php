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
        Schema::create('programs', function (Blueprint $table) {
            $table->id();

            $table->string('program_code');
            $table->string('name');
            $table->integer('total_duration_hours')->unsigned();
            $table->string('version')->default('1')->nullable();

            $table->foreignId('training_level_id')
                ->nullable()
                ->constrained('training_levels')
                ->nullOnDelete();

            $table->foreignId('special_program_name_id')
                ->nullable()
                ->constrained('special_program_names')
                ->nullOnDelete();

            $table->timestamps();

            $table->unique(['program_code', 'version'], 'programs_code_version_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programs');
    }
};
