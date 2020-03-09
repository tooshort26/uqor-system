<?php

namespace App\Http\Controllers\Campus;

use App\Form;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Jobs\CampusSubmitForm;
use App\Campus;

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

    public function upload(Request $request, Form $formId)
    {
        if ($request->has('files')) {
            $destination =  public_path() . '/campus_forms/' . Auth::user()->name .'_' . $request->file('files')[0]->getClientOriginalName();
            move_uploaded_file($request->file('files')[0], $destination);


           \Cloudinary::config(array( 
              'cloud_name' => config('cloudinary.CLOUD_NAME'), 
              'api_key'    => config('cloudinary.API_KEY'), 
              'api_secret' => config('cloudinary.API_SECRET'), 
              'secure'     => true
            ));

             $file_name = $request->file('files');

             $uploaded = \Cloudinary\Uploader::upload($destination, [
                'use_filename'    => true,
                'unique_filename' => false,
                'resource_type'   => 'auto'
            ]);

            return response()->json(['success' => true, 'file_url' => $uploaded['url']]);
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
            $alreadySubmit = Campus::where('id', Auth::user()->id)->whereHas('forms', function ($q) use ($campus_form) {
                $q->where('id', $campus_form->id);
            })->exists();

            if ($alreadySubmit) {
                $campus_form->campus()->detach(Auth::user()->id, ['link' => $request->file_url]);
            }

            $campus_form->campus()->attach(Auth::user()->id, ['link' => $request->file_url]);
            
            // Modidy the link&id of the form by the current upload of the campus.
            $campus_form->link = $request->file_url;
            $campus_form->campus_id = Auth::user()->id;
            $campus_form->name = Auth::user()->name;

            // Publish Notification.
            $publishSubmittedForm = (new CampusSubmitForm($campus_form->toArray()))
                                ->delay(now()->addSeconds(5));

            dispatch($publishSubmittedForm);
            return redirect()->to('/campus/dashboard')->with('success', 'Succesfully submit form');
        } else {
           return redirect()->to('/campus/dashboard')->withErrors(['message' => 'The form submission is already deadline.']);
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
