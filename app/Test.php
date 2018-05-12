<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    //
	public function chapter(){
		return $this->belongsTo('App\Chapter');
	}
	public function questions(){
		return $this->hasMany('App\Question');
	}
}
