<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accessoires', function (Blueprint $table) {
            $table->float('prix');
            $table->string('prixType');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('accessoires', function (Blueprint $table) {
            $table->dropColumn('prix');
            $table->dropColumn('prixType');
        });
    }
}
