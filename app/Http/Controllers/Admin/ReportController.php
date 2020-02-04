<?php

namespace App\Http\Controllers\Admin;

use App\Campus;
use App\Form;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $noOfQuarters = 4;
        $currentYear = date('Y');
        $forms = Form::whereYear('created_at', $currentYear)
                        ->whereBetween('quarter', [1, $noOfQuarters])
                        ->orderBy('created_at', 'DESC')->get()->groupBy(function (Form $form) {
                            return $form->created_at->format('Y') . '_' . $form->created_at->quarter;
                            // return $form->created_at->format('Y') . '_' . $form->quarter;
                        });
        $campus = Campus::with('forms')->get();
        return view('admin.report.index', compact('forms', 'campus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
