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
        Schema::create('tech_inventories', function (Blueprint $table) {
            $table->id();
            $table->string('piece_ref');
            $table->string('tech_email');
            // $table->enum('type', ['Occasion','Neuf']);
            $table->integer('quantity');
            $table->timestamps();
        });

        // Add the foreign key constraint after creating the table
        Schema::table('tech_inventories', function (Blueprint $table) {
            $table->foreign('piece_ref')->references('ref')->on('pieces')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('tech_email')->references('email')->on('users')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tech_inventories');
    }
};
