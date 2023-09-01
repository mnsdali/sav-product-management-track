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
        Schema::create('reclamations', function (Blueprint $table)
            {
                $table->id();
                $table->string('type_panne');
                $table->longText('description_panne');
                $table->enum('etat', ['non_resolu','en_attente', "intervention_en_cours", 'resolu','archive'])->default('non_resolu');
                $table->string('client_pseudo');
                $table->string('tech_email')->nullable();
                $table->string('serie_number');
                $table->decimal('lat', 14, 7)->nullable();
                $table->decimal('lng', 14, 7)->nullable();
                // $table->string('google_maps_coordinates_produit');
                $table->decimal('kilometrage')->nullable();
                $table->timestamps();
            }
        );

        // Add the foreign key constraint after creating the table
        Schema::table('reclamations', function (Blueprint $table) {
            $table->foreign('serie_number')->references('serie_number')->on('articles')->onDelete('cascade');
            $table->foreign('client_pseudo')->references('pseudo')->on('clients')->onDelete('cascade');
            $table->foreign('tech_email')->references('email')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */

    public function down(): void
    {
        Schema::dropIfExists('reclamations');
    }
};
