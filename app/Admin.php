<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable {
	use Notifiable;

	protected $guard = 'admin';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'first_name','last_name', 'email', 'password', 'job_title', 'admin_token','avatar'
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];
	public function courses(){
		return $this->morphMany('App\Course', 'owner');
	}
}