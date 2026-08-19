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
        Schema::create('tournees', function (Blueprint $table) {
            $table->id();
            $table->enum('statut', ['PREVU', 'EN_COUR', 'TERMINEE']);
            $table->date('date');
            $table->string('itineraire');
            $table->unsignedInteger('employe_id');
            $table->unsignedInteger('zone_id');

            $table->foreign('employe_id')
                ->references('id')
                ->on('employes')
                ->onDelete('set null');

            $table->foreign('zone_id')
                ->references('id')
                ->on('zones')
                ->onDelete('set null');
    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tournees');
    }
};
