<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
	        $table->string('last_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean('is_tutor')->nullable();
            $table->string('avatars')->default('users/avatars/default.jpeg');
            $table->string('banner')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
        DB::update("ALTER TABLE users AUTO_INCREMENT = 1000");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
