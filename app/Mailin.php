<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mailin extends Model
{
   protected $fillable = [
	'name', 'email', 'subject','message'
   ];
   protected $hidden = [
   	'userId'
   ];
}
