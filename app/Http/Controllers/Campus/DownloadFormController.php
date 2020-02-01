<?php

namespace App\Http\Controllers\Campus;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DownloadFormController extends Controller
{
    public function getFile(string $filename)
    {
    	$pathToFile =  public_path() . '/admin_forms/' . $filename;
    	return response()->download($pathToFile);
    }
}
