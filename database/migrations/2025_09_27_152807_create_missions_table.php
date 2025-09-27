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
        Schema::create('missions', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Nature/intitulé de la mission
            $table->date('start_date')->nullable(); // Date de début
            $table->date('end_date')->nullable(); // Date de fin
            $table->integer('duration_days')->nullable(); // Durée en jours (alternative aux dates)
            $table->string('company'); // Entreprise qui propose la mission
            $table->enum('status', ['en_cours', 'terminee'])->default('en_cours'); // État de la mission
            $table->text('notes')->nullable(); // Notes supplémentaires
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('missions');
    }
};
