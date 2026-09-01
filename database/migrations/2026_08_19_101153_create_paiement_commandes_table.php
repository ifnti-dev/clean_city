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
        Schema::create('paiement_commandes', function (Blueprint $table) {
            $table->id();
            $table->integer('methode_paiement_id');
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
        Schema::dropIfExists('paiement_commandes');
    }
};
