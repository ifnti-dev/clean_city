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
        Schema::create('menages', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('designation')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longtitude')->nullable();
            $table->boolean('est_abonnee');
            $table->boolean('est_radier');
            $table->boolean('est_valide');
            $table->timestamps();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('quartier_id');
            $table->unsignedBigInteger('type_habitat_id');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
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
