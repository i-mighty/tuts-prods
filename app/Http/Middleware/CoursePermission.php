<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class CoursePermission
{
	protected $auth;
	public function __construct(Guard $auth) {
		$this->auth = $auth;
	}

	/**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
    	
    }

	/**
	 * @param $request
	 *
	 * @return bool
	 */
	public function isAdmin($request):bool {
    	if(Auth::check()){
    		return $request->user()->is_tutor;
	    }
	    return false;
    }
}
