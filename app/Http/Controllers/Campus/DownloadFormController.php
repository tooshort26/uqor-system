<?php

namespace App\Http\Controllers\Campus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DownloadFormController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth:campus');
	}

    public function getFile(string $filename)
    {
    	$pathToFile =  public_path() . '/admin_forms/' . $filename;
    	return response()->download($pathToFile);
    }

    public function getUploadedFile(string $filename)
    {
    	$pathToFile =  public_path() . '/campus_forms/' . md5(Auth::user()->name) .'_'. $filename;
    	return response()->download($pathToFile, Auth::user()->name. ' ' . $filename);
    }
}
