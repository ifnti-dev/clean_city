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
        Schema::create('factures', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nb_mois');
            $table->date('date_debut');
            $table->date('date_fin');
            $table->json('mois')->nullable();  //a demander a monsieur
            $table->unsignedInteger('abonnement_id');
            $table->unsignedInteger('tarif_id');
          
            $table->unsignedBigInteger('methode_paiement_id');

            $table->foreign('abonnement_id')
                ->references('id')
                ->on('abonnements')
                ->onDelete('cascade');

            $table->foreign('tarif_id')
                ->references('id')
                ->on('tarifs')
                ->onDelete('cascade');

            $table->foreign('methode_paiement_id')
                ->references('id')
                ->on('methode_paiements')
                ->onDelete('cascade');

              $table->timestamps();    
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
