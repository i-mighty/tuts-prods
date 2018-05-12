<?php

namespace App\Http\Controllers;

use App\Mailin;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MailinController extends Controller
{
	protected function makeData(Request $request){
		return $data = [
			'name' => $request->input('name'),
			'email' => $request->input('email'),
			'userId' => $request->input('userId'),
			'subject' => $request->input('subject'),
			'message' => $request->input('message'),
		];
	}
    protected function validator(array $data){
	   return Validator::make($data, [
		    'name' => 'required|string|max:255',
		    'email' => 'required|string|email|max:255',
		    'userId' => 'required|integer',
		    'subject' => 'required|string|max:240',
		    'message' => 'required|string|max:240',
	    ]);
    }
    protected  function create(array $data){
    	return Mailin::create([
		    'name' => $data['name'],
		    'email' => $data['email'],
		    'userId' => $data['email'],
		    'subject' => $data['subject'],
		    'message' => $data['message'],
	    ]);
    }
    public function mailinSubmit(Request $request){
    	$data = $this->makeData($request);
    	$validator = $this->validator($data);
    	if ($validator->fails()){
			return;
	    }else{
		    $mailin = $this->create($data);
		    $mailin->save();
		    return view('contact',['submitted' => true]);
	    }

	}

}
