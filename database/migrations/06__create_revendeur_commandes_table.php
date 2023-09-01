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
        Schema::create('revendeur_commandes', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique()->index();
            $table->string('rev_email');
            $table->decimal('total');
            $table->timestamps();
        });

        Schema::table('revendeur_commandes', function (Blueprint $table) {
            $table->foreign('rev_email')->references('email')->on('users')->onUpdate('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('revendeur_commandes');
    }
};
