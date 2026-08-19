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
        //
        Schema::table('paiement_abonnements', function (Blueprint $table) {
            $table->date('date');
            $table->decimal('montant', 8, 3);
            $table->string('id_transaction');
        });


        Schema::table('paiement_commandes', function (Blueprint $table) {
            $table->date('date');
            $table->decimal('montant', 8, 3);
            $table->string('id_transaction');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('paiement_abonnements', function (Blueprint $table) {
            $table->dropColumn('date');
            $table->dropColumn('montant', 8, 3);
            $table->dropColumn('id_transaction');
        });


        Schema::table('paiement_commandes', function (Blueprint $table) {
            $table->dropColumn('date');
            $table->dropColumn('montant', 8, 3);
            $table->dropColumn('id_transaction');
        });
    }
};
