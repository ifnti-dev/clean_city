<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 98473856
     */
    public function up(): void
    {
        Schema::create('menages', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('designation')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->boolean('est_abonnee');
            $table->boolean('est_radier');
            $table->boolean('est_en_regle');
            $table->timestamps();

            $table->integer('client_id');
            $table->integer('quartier_id');
            $table->integer('type_habitat_id');


            $table->foreign('client_id')
                ->references('id')
                ->on('clients')
                ->onDelete('cascade');

            $table->foreign('quartier_id')
                ->references('id')
                ->on('quartiers')
                ->onDelete('cascade');

            $table->foreign('type_habitat_id')
                ->references('id')
                ->on('type_habitats')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menages');
    }
};
