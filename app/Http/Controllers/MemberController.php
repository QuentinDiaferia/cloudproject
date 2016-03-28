<?php

namespace App\Http\Controllers;

use DB;

use App\Http\Requests;

use App\Http\Requests\MemberRequest;

class MemberController extends Controller
{
	public function __construct()
    {
    	$this->middleware('web');
    	$this->middleware('auth');
    }
    public function getForm($n) {
    	return view('group')->with('id', $n);
    }
    public function postForm(MemberRequest $request, $n) {
    	$group = DB::table('groups')->where('id', $n)->first();

        $memberId = DB::table('users')->where('name', $request->member)->value('id');

        if ($memberId == $group->admin OR $memberId == $group->member1 OR $memberId == $group->member2) {
            return view('group')->with(['id' => $n, 'success' => false]);
        }
        else {
            if ($group->member1 == NULL) {
                DB::table('groups')->where('id', $n)->update(['member1' => $memberId]);
            }
            elseif ($group->member2 == NULL) {
                DB::table('groups')->where('id', $n)->update(['member2' => $memberId]);
            }
            return view('group')->with(['id' => $n, 'success' => true]);
        }
    }
}
