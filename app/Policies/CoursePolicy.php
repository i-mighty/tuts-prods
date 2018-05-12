<?php

namespace App\Policies;

use App\Admin;
use App\User;
use App\Course;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class CoursePolicy
{
    use HandlesAuthorization;

	/**
	 * Determine whether the user can view the course.
	 *
	 * @param  \App\User $user
	 * @param  \App\Course $course
	 * @param Admin|null $admin
	 *
	 * @return mixed
	 */
    public function view(User $user = null, Course $course)
    {
    	$owner = $course->owner;
        if($owner->id === $user->id){
			return true;
        }elseif($user){
			$regStatus = $user->registrations()->where('course_id', $course->id)->count();
			if($regStatus > 0){
				return true;
			}
        }
	    return false;
    }

    /**
     * Determine whether the user can create courses.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
	    if (Auth::guard('admin')->check()){
	    	return true;
	    }elseif (Auth::check()){
	    	return Auth::user()->is_tutor;
	    }
    }

	/**
	 * Determine whether the user can update the course.
	 *
	 * @param  \App\User $user
	 * @param  \App\Course $course
	 * @param Admin $admin
	 *
	 * @return mixed
	 */
    public function update(User $user = null , Course $course, Admin $admin = null)
    {
	    $owner = $course->owner;
	    if($owner->id === $user->id){
		    return true;
	    }elseif($owner->id === $admin->id){
		    return true;
	    }
	    return false;
    }

    /**
     * Determine whether the user can delete the course.
     *
     * @param  \App\User  $user
     * @param  \App\Course  $course
     * @return mixed
     */
    public function delete(User $user, Course $course)
    {
        //
	    $owner = $course->owner;
	    if($owner->id === $user->id){
		    return true;
	    }elseif($owner->id === $admin->id){
		    return true;
	    }
	    return false;
    }
}
