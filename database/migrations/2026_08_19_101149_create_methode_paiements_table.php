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
        Schema::create('methode_paiements', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->integer('sold');
            $table->enum('type', ['MOBILE_MONEY', 'ESPECE']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('methode_paiements');
    }
};
