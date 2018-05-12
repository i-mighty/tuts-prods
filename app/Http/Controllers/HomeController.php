<?php

namespace App\Http\Controllers;

use App\Course;
use App\Registration;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$courses_id = Registration::where('user_id', auth()->id())->pluck('course_id');
    	$completed_id = Registration::where('user_id', auth()->id())->where('complete', 100)->pluck('course_id')->toArray();
    	$completed = Course::whereIn('id', $completed_id)->paginate(4);
    	$courses = Course::whereIn('id', $courses_id)->paginate(4);
        return view('home', ['courses' => $courses, 'completed' => $completed]);
    }

	/**
	 * @param Request $request
	 * @param $user_id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function profile(Request $request, $user_id){
		$user = User::find($user_id);
		$this->validate($request, [
			'bio' => 'nullable|string|max:240',
			'pic' => 'mimes:jpg,png,gif,jpeg|nullable'
		]);
		$user->bio = $request->bio;
		if(isset($request->pic)){
			if($user->avatar !== "users/avatars/default.jpeg"){
				Storage::delete($user->avatar);
			}
			$user->avatar = $request->file('pic')->store('users/avatars');
		}
		$user->save();
		$collect = collect($user)->pull('password', null);
		return $collect->put('success', true);
    }
}
