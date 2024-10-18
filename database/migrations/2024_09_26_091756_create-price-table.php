<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePriceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prices', function(Blueprint $table){
            $table->id();
            $table->integer('minJoursReservation');
            $table->integer('maxJoursReservation');
            $table->double('prix');
            $table->unsignedBigInteger('voiture_id');
            $table->foreign('voiture_id')->references('id')->on('voitures')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('saison_id');
            $table->foreign('saison_id')->references('id')->on('saisons')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prices');
    }
}
