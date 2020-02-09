<?php

namespace App\Http\Controllers\President;

use App\Campus;
use App\Form;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:president',['only' => 'index','edit']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quarters = ['First Quarter', 'Second Quarter', 'Third Quarter', 'Fourth Quarter'];

        $campusPendingForms = Campus::with(['forms' => function ($query) {
            $query->where('status', 'pending');
        }])->get();

        $campusApprovedForms = Campus::with(['forms' => function ($query) {
            $query->where('status', 'approved');
        }])->get();

        return view('president.dashboard', compact('campusPendingForms', 'campusApprovedForms', 'quarters'));
    }
}
