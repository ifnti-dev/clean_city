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
            $table->enum('status', ['PREVU', 'EN_COUR', 'TERMINEE'])->default('PREVU');
            $table->date('date');
            $table->string('itineraire')->nullable();
            $table->json('employes_id');
            $table->unsignedBigInteger('zone_id');

            // $table->foreign('employes_id')
            //     ->references('id')
            //     ->on('employes')
            //     ->onDelete('set null');

            $table->foreign('zone_id')
                ->references('id')
                ->on('zones')
                ->onDelete('cascade');

               
    
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
