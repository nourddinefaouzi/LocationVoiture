<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVoitureTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voitures', function(Blueprint $table){
            $table->id();
            $table->string('marque');
            $table->string('modele');
            $table->string('couleur');
            $table->string('immatriculation');
            $table->string('carburant');
            $table->string('puissance');
            $table->double('kilometrage');
            $table->double('prix');
            $table->string('statut');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('voitures');
    }
}
