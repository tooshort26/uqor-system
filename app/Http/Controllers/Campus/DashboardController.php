<?php

namespace App\Http\Controllers\Campus;

use App\Campus;
use App\Form;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    
   public function __construct()
    {
        $this->middleware('auth:campus',['only' => 'index','edit']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $forms = Form::whereYear('created_at',date('Y'))->get();

        $campusSubmittedForm = Campus::with(['forms' => function ($query) {
            $query->whereYear('forms.created_at', date('Y'));
        }, 'forms:id,status'])->find(Auth::user()->id);


        $campusSubmittedFormIds = $campusSubmittedForm->forms->pluck('id')->toArray();
        $campusSubmittedFormStatus = $campusSubmittedForm->forms->pluck('status')->toArray();

        return view('campus.dashboard', compact('forms', 'campusSubmittedFormIds', 'campusSubmittedFormStatus'));
    }

  
}
