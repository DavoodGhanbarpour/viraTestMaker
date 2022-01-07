<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyCorretAnswerMoveInToQuestionDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->dropColumn('correctAnswer');
        });

        Schema::table('questions_detail', function (Blueprint $table) {
            $table->enum('correctAnswer', ['true','false']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->integer('correctAnswer');
        });
        Schema::table('questions_detail', function (Blueprint $table) {
            $table->dropColumn('correctAnswer');
        });
    }
}
