<?php

namespace App\Http\Controllers\Campus;

use App\Campus;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EditProfileController extends Controller
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
    public function edit()
    {
        return view('campus.auth.edit');
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
        $id = Auth::user()->id;
		$campus = Campus::find($id);
		$changePassword = false;

		// Default rules for the validation.

		$rules = [];

		if (!is_null($request->password) || !is_null($request->password_confirmation)) {
			$rules['password'] = 'required|min:8|max:20|confirmed';
			$changePassword = true;
		}

		if ($request->has('profile')) {
			$rules['profile'] = 'mimes:jpeg,jpg,png,gif|required|max:10000';
		}

		$this->validate($request, $rules);

		if ($request->has('profile')) {
			 $time = time();
	         $destination =  public_path() . '/images/user_images/' . $time .'_' .  str_replace(' ', '_', $request->file('profile')->getClientOriginalName());
	         $imageName = $time . '_' . $request->file('profile')->getClientOriginalName();
	         move_uploaded_file($request->file('profile'), $destination);
		}


         if ($changePassword) {
         	$campus->password = $request->password;
         }

         if ($request->has('profile') && $imageName) {
         	$campus->profile = $imageName;
         }

         $campus->save();
         return back()->with('success', 'Successfully update your profile.');

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
