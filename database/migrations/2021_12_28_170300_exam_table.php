<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ExamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('classID');
            $table->integer('dateStart');
            $table->integer('dateFinish');
            $table->mediumInteger('timeStart');
            $table->mediumInteger('timeFinish');
            $table->float('score');
            $table->tinyInteger('timesToTry')->default(0);
            $table->enum('isRandom', [ 'true', 'false' ])->default('true');
            $table->enum('isReviewAllowed', [ 'true', 'false' ])->default('true');
            $table->enum('isMoveAllowed', [ 'true', 'false' ])->default('true');
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
        Schema::drop('exams');
    }
}
