<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    //
	protected $fillable = [
		'course_id','user_id'
	];
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function course(){
    	return $this->belongsTo('App\Course');
    }
}
