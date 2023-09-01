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
        Schema::create('pieces_variations', function (Blueprint $table) {
            $table->id();
            $table->string('piece_ref');
            $table->string('var_designation');
            $table->timestamps();
        });

        Schema::table('pieces_variations', function (Blueprint $table) {
            $table->foreign('var_designation')->references('designation')->on('variations')->onUpdate('cascade');
            $table->foreign('piece_ref')->references('ref')->on('pieces')->onUpdate('cascade');
            // $table->foreign('prod_ref')->references('reference')->on('produits')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pieces_variations');
    }
};
