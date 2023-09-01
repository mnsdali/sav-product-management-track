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
        Schema::create('details_commande_revendeurs', function (Blueprint $table) {
            $table->id();
            $table->string('cmd_ref');
            // $table->string('prod_ref');
            $table->string('var_designation');
            $table->decimal('prix');
            $table->integer('qte');
            $table->decimal('sous_total');
            $table->timestamps();
        });

        Schema::table('details_commande_revendeurs', function (Blueprint $table) {
            $table->foreign('var_designation')->references('designation')->on('variations')->onUpdate('cascade');
            $table->foreign('cmd_ref')->references('reference')->on('revendeur_commandes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('details_commande_revendeurs');
    }
};
