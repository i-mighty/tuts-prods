<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id');
	        $table->string('title');
            $table->integer('user_id');
	        $table->integer('price');
	        $table->string('category');
	        $table->longText('description');
	        $table->morphs('owner');
	        $table->string('banner');
	        $table->timestamps();
        });
	    DB::update("ALTER TABLE courses AUTO_INCREMENT = 1000");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
