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
        Schema::create('ligne_tournees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('menage_id');
            $table->unsignedBigInteger('tournee_id');
            $table->enum('status', ['VIDER', 'NON_VIDER'])->default('NON_VIDER');
            $table->timestamps();
            $table->unique(['menage_id', 'tournee_id']);

            $table->foreign('menage_id')
                ->references('id')
                ->on('menages')
                ->onDelete('set null');

            $table->foreign('tournee_id')
                ->references('id')
                ->on('tournees')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ligne_tournees');
    }
};
