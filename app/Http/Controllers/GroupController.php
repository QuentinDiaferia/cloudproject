<?php

namespace App\Http\Controllers;

use DB;
use Storage;

use App\Group;

use App\Http\Requests\GroupRequest;

class GroupController extends Controller
{
	public function __construct()
    {
    	$this->middleware('web');
    	$this->middleware('auth');
    }

    public function getForm() {
    	return view('creategroup');
    }

    public function postForm(GroupRequest $request) {
    	$name = $request->name;

    	$groupId = DB::table('groups')->insertGetId([
    		'name' => $name,
            'admin' => $request->user()->id
    	]);

        $directory = $name.$groupId;

        Storage::makeDirectory($directory);

    	return view('creategroup')->with('success', true);
    }
}
