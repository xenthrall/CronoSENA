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
        Schema::create('competencies', function (Blueprint $table) {
            $table->id();

            $table->string('code', 50);                     // Codigo de la norma
            $table->string('name', 255);                    // Competency name
            $table->text('description')->nullable();        // Description of the competency
            $table->unsignedInteger('duration_hours');      // Total hours
            $table->string('version')->default('1');        // Version of the competency

            $table->foreignId('competency_type_id')
                ->nullable()
                ->constrained('competency_types')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->timestamps();

            $table->unique(['code', 'version'], 'competencies_code_version_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('competencies');
    }
};
