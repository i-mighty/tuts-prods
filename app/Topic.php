<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    //
	protected $fillable = [
		'title', 'text', 'chapter_id', 'media'
	];
	public function chapter(){
		$this->belongsTo('App\Chapter');
	}
}
