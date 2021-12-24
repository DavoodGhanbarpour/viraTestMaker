<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NewTableClassAssignees extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignees', function (Blueprint $table) {
            $table->id();
            $table->string('classID');
            $table->string('studentID');
            $table->string('trash')->default(0);
        });

        Schema::table('classes', function (Blueprint $table) {
            $table->string('teacherID');
            $table->string('courseID');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::drop('assignees');

       Schema::table('classes', function (Blueprint $table) {
        $table->dropColumn('teacherID');
        $table->dropColumn('courseID');
    });
    }
}
