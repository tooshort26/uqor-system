<?php

namespace App\Http\Controllers\Admin;

use App\Campus;
use App\Http\Controllers\Controller;
use App\Jobs\SendApprovalAccountJob;
use App\Jobs\SendRejectAccountJob;
use Illuminate\Http\Request;

class CampusApprovalController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function approve(Campus $campus)
    {
        // Send an email.
        $campus->approved = 1;
        $campus->save();
        $job = (new SendApprovalAccountJob($campus->email))
                                    ->delay(now()->addSeconds(5));
        dispatch($job);
        return back()->with('success', 'Succesfully approved the campus request.');
    }

    public function reject(Campus $campus)
    {
        // Send an email.
        $campus->delete();
        $job = (new SendRejectAccountJob($campus->email))
                                    ->delay(now()->addSeconds(5));
        dispatch($job);
        return back()->with('success', 'Succesfully reject the campus request.');   
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
    public function update(Request $request)
    {
        
       
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
