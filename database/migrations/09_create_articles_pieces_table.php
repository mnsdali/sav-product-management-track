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
        Schema::create('articles_pieces', function (Blueprint $table) {
            $table->id();
            $table->string('ref');
            $table->boolean('isUsed')->default(0);
            $table->timestamps();
        });

        Schema::table('articles_pieces', function (Blueprint $table) {
            // $table->foreign('var_designation')->references('designation')->on('variations')->onUpdate('cascade');
            $table->foreign('ref')->references('ref')->on('pieces')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles_pieces');
    }
};
