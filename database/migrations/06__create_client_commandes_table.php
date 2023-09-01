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
        Schema::create('client_commandes', function (Blueprint $table) {
            $table->id();
            $table->string('client_pseudo');
            $table->string('rev_email');
            $table->string('total');
            $table->timestamps();
        });

        Schema::table('client_commandes', function (Blueprint $table) {
            $table->foreign('client_pseudo')->references('pseudo')->on('clients')->onUpdate('cascade');
            $table->foreign('rev_email')->references('email')->on('users')->onUpdate('cascade');
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_commandes');
    }
};
