<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameColumnInGirlInterest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('girl_interest', function (Blueprint $table) {
            $table->renameColumn('interest_id', 'interes_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('girl_interest', function (Blueprint $table) {
            //
            $table->renameColumn('interes_id', 'interest_id');
        });
    }
}
