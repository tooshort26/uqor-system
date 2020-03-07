<?php

namespace App\Http\Controllers\Admin;

use App\Form;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use JD\Cloudder\Facades\Cloudder;
use App\Campus;
use App\Http\Controllers\Repository\SMSRepository;
use App\Jobs\SendSMSJob;
use App\Jobs\PublishNewForm;

class FormController extends Controller
{
    public function __construct(SMSRepository $smsRepository)
    {
        $this->middleware('auth:admin');
        $this->smsRepository = $smsRepository;
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $forms = Form::orderBy('created_at', 'DESC')->get()->groupBy(function (Form $form) {
            return $form->created_at->format('Y') . '_' . $form->created_at->quarter;
        });
        return view('admin.forms.index', compact('forms'));
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
            'title'       => 'required',
            'description' => 'required',
            'deadline'    => 'required',
        ]);


        $form = Form::create([
            'title'       => $request->title,
            'description' => $request->description,
            'deadline'    => Carbon::parse($request->deadline),
            'quarter'     => Carbon::now()->quarter,
            'link'        =>  $request->file_url,
        ]);

        session()->forget('file_name');
        $deadlineParse = Carbon::parse($request->deadline);
        $campusPhoneNumbers = Campus::where('approved', '!=', 0)->get(['phone_number'])
                                    ->pluck('phone_number')->toArray();
        $message = "Administrator uploaded a unified form " . $request->title . " - " . $request->description . " - deadline would be in " . $deadlineParse->format('F d, Y');
        $job = (new SendSMSJob($this->smsRepository, $campusPhoneNumbers, $message))
                                ->delay(now()->addSeconds(5));
       dispatch($job);
       
       $publishJob = (new PublishNewForm($form->toArray()))
                                ->delay(now()->addSeconds(5));
       dispatch($publishJob);

        return back()->with('success', 'Succesfully upload new form.');
    }

    /**
     * Endpoint for uloading form
     */
    public function uploadForm(Request $request)
    {
        if ($request->has('files')) {

            // Need to upload the file first then get
            $destination =  public_path() . '/admin_forms/' . str_replace(' ', '_', $request->file('files')[0]->getClientOriginalName());
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

    public function downloadForm(string $filename)
    {
        return response()->download($filename);
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
