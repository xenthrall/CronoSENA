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
        Schema::create('instructors', function (Blueprint $table) {
            $table->id();
            
            $table->string('document_number')->unique();
            $table->string('document_type')->nullable();
            $table->string('full_name')->nullable();
            $table->string('name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable()->unique();
            $table->string('institutional_email')->nullable()->unique(); // correo institucional
            $table->string('phone')->nullable();

            // Campos de autenticación
            $table->string('password')->nullable();
            $table->rememberToken(); // Para el "recuérdame"
            $table->timestamp('email_verified_at')->nullable(); // (Más adelante para verificación de email)

            // Relaciones
            $table->foreignId('executing_team_id')
                ->nullable()
                ->constrained('executing_teams')
                ->nullOnDelete();

            /*
            $table->foreignId('profession_id')
                ->nullable()
                ->constrained('professions')
                ->cascadeOnUpdate()
                ->nullOnDelete();
            */

            $table->string('specialty')->nullable();
            $table->string('photo_url')->nullable();
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instructors');
    }
};
