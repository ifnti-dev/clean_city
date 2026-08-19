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
        Schema::create('zones', function (Blueprint $table) {
            $table->id();
            $table->text('designation');
            $table->unsignedInteger('employe_id');
            $table->unsignedInteger('quartier_id');

            $table->foreign('quartier_id')
                ->references('id')
                ->on('quartiers')
                ->onDelete('set null');

            $table->foreign('employe_id')
                ->references('id')
                ->on('employes')
                ->onDelete('set null');

    

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zones');
    }
};
