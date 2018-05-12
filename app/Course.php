<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    /**
     * The primary key on the flights table
     *
     * @var integer
     */

    protected $fillable = [
        'title','price','description','banner', 'category', 'owner_id', 'owner_type'
    ];
    protected $hidden = [

    ];
    public function owner(){
	    return $this->morphTo();
    }
    public function chapters(){
        return $this->hasMany('App\Chapter');
    }
    public function registrations(){
    	return $this->hasMany('App\Registration');
    }
    public function comments(){
    	return $this->morphMany('App\Comment', 'commentable');
    }
}
