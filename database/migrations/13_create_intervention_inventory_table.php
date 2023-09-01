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
        Schema::create('intervention_inventory', function (Blueprint $table) {

            $table->id();
            $table->integer('quantity');
            $table->timestamps();

            $table->foreignId('intervention_id')->constrained('interventions')->cascadeOnDelete();
            $table->string('piece_ref');

        });

        // Add the foreign key constraint after creating the table
        Schema::table('intervention_inventory', function (Blueprint $table) {
            $table->foreign('piece_ref')->references('ref')->on('pieces')->onDelete('cascade');
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('intervention_inventory');
    }
};

