<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Course;
use App\Registration;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
	/**
	 * CourseController constructor.
	 * Assigns middleware to specific method within the file
	 */
	public function __construct(Request $request) {
		$this->middleware('multi_auth')->except('index');
	}


	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        //
        $courses = Course::take(100)->paginate(20);
        if($courses->isEmpty()){
            $empty = true;
            return view('courses.courses',['empty'=> $empty]);
        }else{
            $empty = false;
            return view('courses.courses',['empty'=> $empty, 'courses' => $courses]);
        }

        return view('courses.courses',[]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        //
//	    $this->authorize('create',Course::class);
        return view('courses.create');
    }
    protected function makeData(Request $request){
        return $data = [
            'title' => $request->input('title'),
			'price' => $request->input('price'),
			'user_id' => $request->input('user_id'),
	        'category' => $request->input('category'),
			'description' => $request->input('description'),
        ];
    }
    protected function validator(array $data){
        return Validator::make($data, [
            'title' => 'required|string|max:255',
            'price' => 'nullable|integer',
            'user_id' => 'required|integer',
            'category' => 'string|required',
            'description' => 'required',
        ]);
    }
    protected function createCourse(array $data, Request $request){
        return new Course([
            'title' => $data['title'],
            'price' => $data['price'],
            'category' => $data['category'],
            'description' => $data['description'],
            'banner' => $request->file('banner')->store('courses/banners'),
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        //
	    if(Auth::check()){
	    	$owner = User::find($request->input('user_id'));
	    }else{
	    	$owner = Admin::find($request->input('user_id'));
	    }
        $data = $this->makeData($request);
        $validator = $this->validator($data);
	    $course = $this->createCourse($data,$request);
	    echo $owner->courses()->save($course);
	    return redirect('courses/'.$course->id.'/edit');
    }

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Course $course
	 * @param Request $request
	 *
	 * @return \Illuminate\Http\Response
	 */
    public function show($course_id){
    	$course = Course::find($course_id);
    	if (Auth::check()){
		    if(Auth::user()->can('view', $course)){
			    return view('courses.course',['course' => $course]);
		    }
	    }elseif (Auth::guard('admin')->check()){
			    return view('courses.course',['course' => Course::find($course_id)]);
	    }
	    return redirect()->route('intro',[ 'course_id' => $course_id] );
	    echo ($course->owner);
    }

	/**
	 * @param $course_id
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function register($course_id){
    	return view('courses.register', ['course' => Course::find($course_id)]);
    }

	/**
	 * @param Request $request
	 *
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	public function addRegistration (Request $request) {
		//Free or Paying?
		//
		auth()->user()->registrations()->create([
			'course_id' => $request->input('course'),
		]);
		return redirect('courses/'.$request->input('course'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit($course_id){
    	$course  = Course::find($course_id);
    	if (Auth::guard('admin')->check()){
    		if(Auth::guard('admin')->user()->id === $course->owner_id){
    			return view('courses.edit', ['course' => $course]);
		    }
		    echo $course;
	    }elseif (auth()->check()){
    		if (auth()->user()->id === $course->owner->id){
    			return view('courses.edit', ['course' => $course]);
		    }
	    }else{
    		return redirect('courses/'.$course->id);
	    }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $course_id){
        $course = Course::find($course_id);
        return $course;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course){
        //
    }
}
