<?php

use Faker\Generator as Faker;

$factory->define(App\Admin::class, function (Faker $faker) {
	//
	static $password;
	    return [
		    'first_name' => $faker->firstName('female'),
		    'last_name' => $faker->lastName,
		    'admin_token' => str_random(16),
		    'job_title' => $faker->jobTitle,
		    'email' => $faker->unique()->safeEmail,
		    'password' => $password ?: $password = bcrypt('secret'),
		    'remember_token' => str_random(10),
	    ];
});
