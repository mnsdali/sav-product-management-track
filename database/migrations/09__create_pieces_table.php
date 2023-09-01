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
        Schema::create('pieces', function (Blueprint $table) {

            $table->id();
            $table->string('ref')->index();
            $table->string('designation');
            $table->string('photo')->nullable();
            $table->string('indice_arrivage');
            $table->unsignedBigInteger('qte_sav')->default(0);
            $table->unsignedBigInteger('qte_stock');
            // $table->string('var_designation');
            // $table->string('prod_ref');

        });

        Schema::table('pieces', function (Blueprint $table) {
            // $table->foreign('var_designation')->references('designation')->on('variations')->onUpdate('cascade');
            // $table->foreign('prod_ref')->references('reference')->on('produits')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pieces');
    }
};
