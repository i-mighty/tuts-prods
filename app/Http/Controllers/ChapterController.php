<?php

namespace App\Http\Controllers;

use App\Chapter;
use App\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @param  $course_id
     */
    public function create($course_id)
    {
        //
	    $course = Course::find($course_id);
	    return view('courses.chapter.create', ['course' => $course]);
    }
	protected function makeData(Request $request){
		return $data = [
			'title' => $request->input('title'),
			'number' => $request->input('number'),
		];
	}
	protected function validator(array $data){
		return Validator::make($data, [
			'title' => 'required|string|max:255',
			'number' => 'required|integer',
		]);
	}
	protected function createChapter(array $data){
		return new Chapter([
			'title' => $data['title'],
			'number' => $data['number'],
		]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 *
	 * @return \Illuminate\Http\Response
	 * @internal param array $data
	 *
	 * @internal param Request $request
	 */
    public function store(Request $request)
    {
    	$data = $this->makeData($request);
    	$course = Course::find($request->course_id);
    	$validator = $this->validator($data);
    	$chapter = $this->createChapter($data);
    	$course->chapters()->save($chapter);
    	return redirect('courses/'.$course->id.'/edit');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Chapter  $chapter
     * @return \Illuminate\Http\Response
     */
    public function show(Chapter $chapter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Chapter  $chapter
     * @return \Illuminate\Http\Response
     */
    public function edit(Chapter $chapter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Chapter  $chapter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //XHR accessed
	    switch ($request->action){
		    case 'rename': return $this->rename($request);
	    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Chapter  $chapter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chapter $chapter)
    {
        //
	    echo 'LIEEEEEEEEEEE';
    }
    public function rename(Request $request){
	    $chapter = Chapter::find($request->id);
	    $chapter->title = $request->title;
	    $chapter->save();
	    return collect($chapter)->put('saved', true);
    }
}
