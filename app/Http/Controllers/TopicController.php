<?php

namespace App\Http\Controllers;

use App\Topic;
use App\Chapter;
use App\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TopicController extends Controller
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
	 * @param $course_id
	 * @param $chapter_id
	 *
	 * @return \Illuminate\Http\Response
	 */
    public function create($course_id, $chapter_id)
    {
        //
	    $course = Course::find($course_id);
	    $chapter = Chapter::find($chapter_id);
	    return view('courses.topic.create',['course' => $course, 'chapter'=> $chapter]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$chapter = Chapter::find($request->chapter_id);
        $request->validate([
        	'title' => 'required|string',
	        'text' =>'string|nullable',
	        'media_file' => 'mimes:mp4,mkv,avi,webm|nullable'
        ]);
        $topic = new Topic([
        	'title' => $request->input('title'),
        	'text' => $request->input('text'),
        	'media' => $request->file('media_file')->store('courses/medias'),
        ]);
        $chapter->topics()->save($topic);
        return redirect('courses/'.$request->input('course_id').'/edit');
    }

	/**
	 * Display the specified resource.
	 *
	 * @param $course_id
	 * @param $chapter_id
	 * @param $topic_id
	 *
	 * @return \Illuminate\Http\Response
	 * @internal param Topic $topic
	 */
    public function show($course_id, $chapter_id, $topic_id)
    {
	     /** @var TYPE_NAME $topic */
		$topic = Topic::find($topic_id);
		$collection = collect($topic);
		$collection->put('poster', Course::find($course_id)->banner);
		echo $collection->toJson();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function edit(Topic $topic)
    {
        //
    }

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\Response
	 * @internal param Topic $topic
	 */
    public function update(Request $request)
    {
        //XHR accessed
	    switch ($request->action){
		    case 'rename': return $this->rename($request);
		    case 'text' : return $this->saveText($request);
		    case 'media':return $this->newMedia($request);

	    }
    }

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param Request $request
	 *
	 * @return \Illuminate\Http\Response
	 * @internal param Topic $topic
	 */
    public function destroy(Request $request)
    {
    	//XHR accessed
		switch ($request->target){
			case 'media': return $this->deleteMedia($request);
			case 'topic':return $this->delete($request);
			default: return $this->delete($request);
		}
    }

	/**
	 * @param Request $request
	 *
	 * @return $this
	 */
	private function saveText(Request $request){
    	$topic = Topic::find($request->id);
    	$topic->text = $request->text;
    	$topic->save();
	    return $collection = collect($topic)->put('success', true);
    }

	/**
	 * @param Request $request
	 *
	 * @return mixed
	 */
	private function newMedia(Request $request){
		$request->validate([ 'media_file' => 'mimes:mp4,mkv,avi,webm|nullable']);
		$topic = Topic::find($request->id);
	    Storage::delete($topic->media);//Delete current media file
	    $topic->media = $request->file('media')->store('courses/medias');
	    $topic->save();
		return $collection = collect($topic)->put('success', true);
    }

	/**
	 * @param Request $request
	 *
	 * @return $this
	 */
	private function rename(Request $request){
	    $topic = Topic::find($request->id);
	    $topic->title = $request->title;
	    $topic->save();
		return $collection = collect($topic)->put('success', true);
    }

	/**
	 * @param Request $request
	 *
	 * @return $this
	 */
	private function deleteMedia(Request $request){
    	$topic = Topic::find($request->id);
    	Storage::delete($topic->media);
    	$topic->media = null;
    	$topic->save();
		return $collection = collect($topic)->put('success', true);
    }

	/**
	 * @param Request $request
	 *
	 * @return $this
	 */
	private function delete(Request $request){
		$topic = Topic::find($request->id);
		Storage::delete($topic->media);
	    $collect = collect($topic)->put('success', true);
		$topic->delete();
		return $collect;
    }
}
