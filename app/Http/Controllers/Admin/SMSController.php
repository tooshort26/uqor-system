<?php

namespace App\Http\Controllers\Admin;

use App\Campus;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Repository\SMSRepository;
use App\Jobs\SendSMSJob;
use Carbon\Carbon;
use Illuminate\Http\Request;
use SMSGatewayMe\Client\ApiClient;
use SMSGatewayMe\Client\Api\MessageApi;
use SMSGatewayMe\Client\Configuration;
use SMSGatewayMe\Client\Model\SendMessageRequest;

class SMSController extends Controller
{
    private $smsRepository;

    public function __construct(SMSRepository $smsRepo)
    {
        $this->middleware('auth:admin');
        $this->smsRepository = $smsRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $campuses = Campus::get();
        return view('admin.sms.index', compact('campuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('admin.sms.create');
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
        'phone_numbers' => 'required',
        'message'      => 'required'
      ]);

       // Convert phone numbers to array and split
       $phone_numbers = explode(',', $request->phone_numbers);
       $job = (new SendSMSJob($this->smsRepository, $phone_numbers, $request->message))
                                ->delay(now()->addSeconds(5));
       dispatch($job);
     
       return redirect()->back()->with('success', 'Succesfully send a message');
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
