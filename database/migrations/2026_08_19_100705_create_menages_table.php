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
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('quartier_id')->nullable();
            $table->unsignedInteger('type_habitat_id')->nullable();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('set null');

            $table->foreign('quartier_id')
                ->references('id')
                ->on('quartiers')
                ->onDelete('set null');

            $table->foreign('type_habitat_id')
                ->references('id')
                ->on('type_habitats')
                ->onDelete('set null');
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
