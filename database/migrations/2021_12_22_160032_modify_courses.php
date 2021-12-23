<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyCourses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn('level');
            $table->dropColumn('code');
            $table->dropColumn('parent');
            $table->string('categoryID',11);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->string('level', 100);
            $table->string('code', 100);
            $table->string('parent', 100);
            $table->dropColumn('categoryID');
        });
    }
}
