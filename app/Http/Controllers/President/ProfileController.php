<?php

namespace App\Http\Controllers\President;

use App\President;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth:president');
	}

	public function edit()
	{
		return view('president.auth.edit');
	}

	public function update(Request $request)
	{
		$id = Auth::user()->id;
		$president = President::find($id);
		$changePassword = false;

		// Default rules for the validation.

		$rules = [
			'name'  => 'required',
			'email' => 'required|unique:presidents,email,'. $id,
		];

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

         $president->name = $request->name;
         $president->email = $request->email;

         if ($changePassword) {
         	$president->password = bcrypt($request->password);
         }

         if ($request->has('profile') && $imageName) {
         	$president->profile = $imageName;
         }

         $president->save();
         return back()->with('success', 'Successfully update your profile.');


	}
}
