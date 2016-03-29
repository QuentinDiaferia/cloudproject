<?php

namespace App\Http\Controllers;

use Storage;
use DB;
use Response;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Http\Requests;
use App\Http\Requests\UploadRequest;

class DropzoneController extends Controller
{
    public function uploadFile(UploadRequest $request, $n) {

    	$nameGroup = DB::table('groups')->where('id', $n)->value('name');

    	$file = $request->file('file');
    	Storage::put($nameGroup.$n.'/'.$file->getClientOriginalName(), $file);

    }

    public function downloadFile($n, $file) {

    	$nameGroup = DB::table('groups')->where('id', $n)->value('name');

    	$dlFile = Storage::get($nameGroup.$n.'/'.$file);
 
		return response()->download(storage_path(getMetaData($nameGroup.$n.'/'.$file), $file, ['Content-Type' => Storage::mimeType($nameGroup.$n.'/'.$file)]));;

    }

    public function deleteFile($n, $file) {

    	$nameGroup = DB::table('groups')->where('id', $n)->value('name');
    	Storage::delete($nameGroup.$n.'/'.$file);

    	return Redirect::to('group/'.$n);

    }
}
