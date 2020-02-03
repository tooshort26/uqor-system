<?php

namespace App\Http\Controllers\Admin;

use App\Campus;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Repository\FormRepository;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private $formRepository;

    public function __construct(FormRepository $formRepo)
    {
        $this->middleware('auth:admin',['only' => 'index','edit']);
        $this->formRepository = $formRepo;
        // dd($this->formRepository->remindSubmission());
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
