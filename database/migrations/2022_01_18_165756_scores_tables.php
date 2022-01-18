<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ScoresTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scores', function (Blueprint $table) {
            $table->id();
            $table->integer('examID');
            $table->integer('studentID');
            $table->string('timeStart');
            $table->string('timeFinish');
            $table->string('trash')->default(0);
        });

        Schema::create('scores_detail', function (Blueprint $table) {
            $table->id();
            $table->integer('scoreID');
            $table->integer('questionID');
            $table->integer('answer');
            $table->integer('answerTime');
            $table->string('trash')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('scores');
        Schema::drop('scores_detail');
    }
}
