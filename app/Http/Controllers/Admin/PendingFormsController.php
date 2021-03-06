<?php

namespace App\Http\Controllers\Admin;

use App\Campus;
use App\Comment;
use App\Form;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PendingFormsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function addComment(int $formId, Request $request)
    {
        $form = Form::find($formId);
        
        $comment = new Comment();
        $comment->body = $request->comment;
        $form->comments()->save($comment);

        return response()->json(['success' => true, 'comment' => $comment->body, 'comment_at' => $comment->created_at->diffForHumans()]);
    }

    public function approve(int $campusId, int $formId)
    {
        $campus = Campus::with(['forms' => function ($query) use($formId) {
            $query->where('form_id', $formId);
        }])->find($campusId);
        
        $campus->forms()->updateExistingPivot($formId, ['status' => 'approved'], false);

        return back()->with('success', 'Succesfully approved the form.');

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
        }, 'forms.comments'])->find($campusId);
        return view('admin.forms.pending.show', compact('campusWithForm', 'formId'));
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
