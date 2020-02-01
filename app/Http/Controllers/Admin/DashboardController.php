<?php

namespace App\Http\Controllers\Admin;

use App\Campus;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin',['only' => 'index','edit']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $campusAccountRequest = Campus::where('approved', '!=' , 1)->get();
        return view('admin.dashboard', compact('campusAccountRequest'));
    }
  
}
