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
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->decimal('montant', 8, 3);
            $table->boolean('est_acceptee');
            $table->text('raison')->nullable();
            $table->enum('statut_livraison', ['EN_ATTENTE', 'REJETER', 'DEBUTER', 'LIVRER'])->default('EN_ATTENTE');
            $table->date('date')->default(now());
            $table->timestamps();
            $table->integer('client_id');
            
            $table->foreign('client_id')
                ->references('id')
                ->on('clients')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commandes');
    }
};
