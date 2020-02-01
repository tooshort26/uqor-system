<?php

namespace App\Http\Controllers\Admin;

use App\Form;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FormController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $quarters = ['First Quarter', 'Second Quarter', 'Third Quarter', 'Fourth Quarter'];
        $currentQuarter = $quarters[Carbon::now()->quarter - 1];
        return view('admin.forms.form-upload', compact('currentQuarter'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'deadline' => 'required',
        ]);

        Form::create([
            'title'       => $request->title,
            'description' => $request->description,
            'deadline'    => Carbon::parse($request->deadline),
            'quarter'     => Carbon::now()->quarter,
            'link'        =>  session('file_name'),
        ]);

        session()->forget('file_name');

        return back()->with('success', 'Succesfully upload new form.');
    }

    /**
     * Endpoint for uloading form
     */
    public function uploadForm(Request $request)
    {
        if ($request->has('files')) {
            $time = time();
            $destination =  public_path() . '/admin_forms/' . $time .'_' .  str_replace(' ', '_', $request->file('files')[0]->getClientOriginalName());
            session(['file_name' => $time .'_' .  str_replace(' ', '_', $request->file('files')[0]->getClientOriginalName())]);
            move_uploaded_file($request->file('files')[0], $destination);
            return response()->json(['success' => true]);
        }
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
