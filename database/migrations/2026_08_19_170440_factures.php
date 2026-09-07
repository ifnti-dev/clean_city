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
            $table->integer('nb_mois');
            $table->date('date_debut')->default('now()');
            $table->date('date_fin');
            $table->json('les_mois')->nullable(); 
            $table->enum('etat_paiement', ['EN_ATTENTE', 'PAIYEE', 'ECHOUEE'])->default('EN_ATTENTE');

            $table->integer('abonnement_id');
            $table->integer('tarif_id');

            $table->integer('methode_paiement_id');

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
