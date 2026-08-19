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
        Schema::create('paiement_abonnements', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('nb_mois');
            $table->date('date_debut');
            $table->date('date_fin');
            $table->json('mois');  //a demander a monsieur
            $table->timestamps();
            $table->unsignedInteger('methode_paiement_id');

            $table->foreign('methode_paiement_id')
                ->references('id')
                ->on('methode_paiements')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paiements');
    }
};
