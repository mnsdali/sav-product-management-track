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
        Schema::create('variations', function (Blueprint $table) {
            $table->id();
            $table->string('designation')->index();
            $table->boolean('est_disponible')->default(1);
            $table->string('prod_ref');
            $table->timestamps();
        });

        // Add the foreign key constraint after creating the table
        Schema::table('variations', function (Blueprint $table) {
            $table->foreign('prod_ref')->references('reference')->on('produits')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('variations');

    }
};
