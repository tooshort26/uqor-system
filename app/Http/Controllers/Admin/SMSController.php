<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SMSGatewayMe\Client\ApiClient;
use SMSGatewayMe\Client\Api\MessageApi;
use SMSGatewayMe\Client\Configuration;
use SMSGatewayMe\Client\Model\SendMessageRequest;

class SMSController extends Controller
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
        return view('admin.sms.index');
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

       $this->validate($request, [
        'phone_number' => 'required',
        'message'      => 'required'
      ]);

        // Configure client
        $config = Configuration::getDefaultConfiguration();
        $config->setApiKey('Authorization', config('sms.token'));
        $apiClient = new ApiClient($config);
        $messageClient = new MessageApi($apiClient);


         $messageRequest = new SendMessageRequest([
                'phoneNumber' => $request->phone_number,
                'message' => $request->message,
                'deviceId' => config('sms.deviceId'),
         ]);
         $sendMessages = $messageClient->sendMessages([$messageRequest]);
         return redirect()->back()->with('success', 'Succesfully send a message to ' . $request->phone_number);
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
