<?php

namespace App\Http\Controllers\Admin;

use App\Campus;
use App\Form;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Repository\FormRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $noOfCampus               = Campus::count();
        $noOfForms                = Form::count();
        $noOfCampusSubmittedForms = DB::table('campus_form')->count();
        $campusAccountRequest     = Campus::where('approved', '!=' , 1)->get();
        $noOfQuarters             = 4;
        $currentYear              = date('Y');
        
        $forms = Form::whereYear('created_at', $currentYear)
                        ->whereBetween('quarter', [1, $noOfQuarters])
                        ->orderBy('created_at', 'DESC')->get()->groupBy(function (Form $form) {
                            return $form->created_at->format('Y') . '_' . $form->created_at->quarter;
                            // return $form->created_at->format('Y') . '_' . $form->quarter;
                        });
        $campus = Campus::with('forms')->get();
        return view('admin.dashboard', compact('campusAccountRequest', 'campus', 'forms' , 'noOfCampusSubmittedForms', 'noOfForms', 'noOfCampus'));
    }
  
}
