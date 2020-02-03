<?php

namespace App\Http\Controllers\Admin;

use App\Campus;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DownloadCampusSubmittedFormController extends Controller
{
	public function __construct()
	{
		return $this->middleware('auth:admin');
	}

    public function getFile(string $filename, Campus $campus)
    {
		$pathToFile =  public_path() . '/campus_forms/' . md5($campus->name) .'_'. $filename;
    	return response()->download($pathToFile, $campus->name . ' ' . $filename);
    }

}
