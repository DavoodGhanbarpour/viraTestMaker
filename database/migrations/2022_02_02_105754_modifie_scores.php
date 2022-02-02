<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifieScores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('scores', function (Blueprint $table) {
            $table->dropColumn('scoreIfCorrect');
        });
        Schema::table('scores_detail', function (Blueprint $table) {
            $table->float('scoreIfCorrect');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('scores', function (Blueprint $table) {
            $table->integer('scoreIfCorrect');
        });
        Schema::table('scores_detail', function (Blueprint $table) {
            $table->integer('scoreIfCorrect');
        });
    }
}
