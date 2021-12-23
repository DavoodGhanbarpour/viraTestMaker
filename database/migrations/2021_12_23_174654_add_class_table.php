<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddClassTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('semesterID');
            $table->string('code')->unique();
            $table->string('timeStart');
            $table->string('timeFinish');
            $table->string('trash')->default(0);
        });

        Schema::create('semesters', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('code')->unique();
            $table->enum('isActive', ['true','false']);
            $table->string('timeStart');
            $table->string('timeFinish');
            $table->enum('type', ['WINTER', 'SPRING', 'SUMMER']);
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
        Schema::drop('classes');
        Schema::drop('semesters');
    }
}
