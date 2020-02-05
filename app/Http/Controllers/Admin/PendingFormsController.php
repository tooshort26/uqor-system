<?php

namespace App\Http\Controllers\Admin;

use App\Campus;
use App\Form;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PendingFormsController extends Controller
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
        $quarters = ['First', 'Second', 'Third', 'Fourth'];
        $campuses = Campus::with(['forms' => function ($query) {
            $query->where('status', '!=', 'approved');
        }])->get();

        return view('admin.forms.pending.index', compact('campuses', 'quarters'));
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
     * @param  int  $id Form Id
     * @return \Illuminate\Http\Response
     */
    public function show(int $campusId, int $formId)
    {
        $campusWithForm = Campus::with(['forms' => function ($query) use($formId) {
            $query->where('form_id', $formId);
        }])->find($campusId);
        return view('admin.forms.pending.show', compact('campusWithForm'));
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
