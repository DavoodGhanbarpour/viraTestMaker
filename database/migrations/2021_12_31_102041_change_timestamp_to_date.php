<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTimestampToDate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('exams', function (Blueprint $table) {
            $table->dateTime('dateStart')->change();
            $table->dateTime('dateFinish')->change();
            $table->dropColumn('timeStart');
            $table->dropColumn('timeFinish');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('exams', function (Blueprint $table) {
            $table->integer('dateStart')->change();
            $table->integer('dateFinish')->change();
            $table->mediumInteger('timeStart');
            $table->mediumInteger('timeFinish');
        });
    }
}
