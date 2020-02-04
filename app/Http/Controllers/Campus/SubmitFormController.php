<?php

namespace App\Http\Controllers\Campus;

use App\Form;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubmitFormController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:campus');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $campus = Auth::user();
        $forms = $campus->forms->groupBy(function (Form $form) {
            return $form->created_at->format('Y') . '_' . $form->created_at->quarter;
        });
        return view('campus.forms.index', compact('forms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
    public function edit(Form $campus_form)
    {
        return view('campus.forms.submit-form', compact('campus_form'));
    }

    public function upload(Request $request, string $link)
    {
        if ($request->has('files')) {
            $destination =  public_path() . '/campus_forms/' . md5(Auth::user()->name) .'_' . $link;
            move_uploaded_file($request->file('files')[0], $destination);
            return response()->json(['success' => true]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Form $campus_form)
    {
        if (!$campus_form->deadline->isPast()) {
            $campus_form->campus()->attach(Auth::user()->id);
            return redirect()->to('/campus/dashboard')->with('success', 'Succesfully submit form');
        } else {
           return rredirect()->to('/campus/dashboard')->withErrors(['message' => 'The form submission is already deadline.']);
        }
        
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
