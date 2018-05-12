<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model{
    //
    protected $fillable = [
       'course_id', 'title','number',
    ];
    public function topics(){
        return $this->hasMany('App\Topic');
    }
    public function course(){
    	return $this->belongsTo('App\Course');
    }
    public function test(){
    	return $this->hasOne('App\Test');
    }
}
