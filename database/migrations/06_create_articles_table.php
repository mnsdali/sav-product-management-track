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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('serie_number')->unique()->index();
            $table->string('client_pseudo')->nullable();
            $table->string('rev_email')->nullable();
            // $table->string('prod_ref');
            $table->string('var_designation');
            $table->string('cmd_ref')->nullable()->default(null);
            $table->unsignedBigInteger('cl_cmd_id')->nullable()->default(null);
            $table->boolean('status'); //vendu ou pas
            $table->timestamps();
        });

        // Add the foreign key constraint after creating the table
        Schema::table('articles', function (Blueprint $table) {
            $table->foreign('var_designation')->references('designation')->on('variations')->onUpdate('cascade');
            // $table->foreign('prod_ref')->references('reference')->on('produits')->onUpdate('cascade');
            $table->foreign('client_pseudo')->references('pseudo')->on('clients')->onUpdate('cascade');
            $table->foreign('rev_email')->references('email')->on('users')->onUpdate('cascade');
            $table->foreign('cmd_ref')->references('reference')->on('revendeur_commandes')->onDelete('cascade');
            $table->foreign('cl_cmd_id')->references('id')->on('client_commandes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
