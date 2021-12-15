<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Courses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('courses', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('title', 100);
        //     $table->string('code', 100);
        //     $table->string('parent', 100);
        //     $table->timestamp('created_at')->useCurrent();
        //     $table->timestamp('updated_at')->useCurrent();
            
        // });

        // Schema::table('users', function (Blueprint $table) {
        //     $table->timestamp('created_at')->useCurrent()->change();
        //     $table->timestamp('updated_at')->useCurrent()->change();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('courses');
        
        // Schema::table('users', function (Blueprint $table) {
        //     $table->timestamp('created_at')->defaul('')->change();
        //     $table->timestamp('updated_at')->default('')->change();
        // });
    }
}
