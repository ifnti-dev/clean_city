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
        Schema::create('abonnements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employe_approuve_id')->nullable();
           
            $table->date('date_debut')->nullable();
            $table->date('date_fin')->nullable();

            $table->enum('etat', ['ACTIF', 'INACTIF'])->default('INACTIF');
            $table->enum('status', ['EN_ATTENTE', 'EN_COUR_DE_TRAITEMENT', 'APPROUVER', 'REJETER'])->default('EN_ATTENTE');
            $table->string('motif_rejet')->nullable();
            $table->unsignedBigInteger('menage_id');

            

            $table->foreign('employe_approuve_id')
                ->references('id')
                ->on('employes')
                ->onDelete('set null');

            $table->foreign('menage_id')
                ->references('id')
                ->on('menages')
                ->onDelete('cascade');

            $table->softDeletes()->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abonnements');
    }
};
