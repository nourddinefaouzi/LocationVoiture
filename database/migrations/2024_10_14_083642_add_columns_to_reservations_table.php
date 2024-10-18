<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->unsignedBigInteger('voiture_id');
            $table->foreign('voiture_id')->references('id')->on('voitures')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('secondDriver')->nullable();
            $table->string('codeContrat');
            $table->float('prixVoiture');
            $table->string('pickUp');
            $table->string('dropOff');
            $table->double('total');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropForeign('voiture_id');
            $table->dropColumn('secondDriver');
            $table->dropColumn('codeContrat');
            $table->dropColumn('voiture_id');
            $table->dropColumn('prixVoiture');
            $table->dropColumn('pickUp');
            $table->dropColumn('dropOff');
            $table->dropColumn('total');
        });
    }
}
