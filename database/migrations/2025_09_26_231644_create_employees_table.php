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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->integer('age');
            $table->string('zone_rurale');
            $table->string('telephone')->nullable();
            $table->string('identifiant')->nullable();
            $table->integer('experience_annees');
            $table->json('experience_cultures'); // maraîchage, arboriculture, ornementale, élevage
            $table->json('specialites'); // stocke les spécialités sous forme de tableau
            $table->boolean('disponible')->default(true);
            $table->timestamps();
        });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
