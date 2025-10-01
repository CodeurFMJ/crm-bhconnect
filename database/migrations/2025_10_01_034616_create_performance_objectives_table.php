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
        Schema::create('performance_objectives', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nom de l'objectif (ex: "Chiffre d'affaires mensuel")
            $table->string('type'); // Type d'objectif (revenue, clients, appointments, etc.)
            $table->decimal('target_value', 15, 2); // Valeur cible
            $table->string('unit')->default('FCFA'); // Unité (FCFA, nombre, pourcentage)
            $table->string('period'); // Période (monthly, quarterly, yearly)
            $table->text('description')->nullable(); // Description de l'objectif
            $table->boolean('is_active')->default(true); // Objectif actif ou non
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('performance_objectives');
    }
};