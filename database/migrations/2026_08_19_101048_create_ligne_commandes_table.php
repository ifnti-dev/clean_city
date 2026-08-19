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
       Schema::create('ligne_commandes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedInteger('produit_id');
            $table->unsignedInteger('commande_id');
            $table->unsignedInteger('quantite');
            $table->unsignedInteger('prix_courrant');
            $table->unsignedInteger('montant');

            $table->foreign('produit_id')
                ->references('id')
                ->on('produits')
                ->onDelete('set null');

            $table->foreign('commande_id')
                ->references('id')
                ->on('commandes')
                ->onDelete('set null');    


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ligne_commandes');
    }
};
