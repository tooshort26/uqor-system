<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth:admin');
	}

	public function edit()
	{
		return view('admin.auth.edit');
	}

	public function update(Request $request)
	{
		$id = Auth::user()->id;
		$admin = Admin::find($id);
		$changePassword = false;

		// Default rules for the validation.

		$rules = [
			'name'  => 'required',
			'email' => 'required|unique:admins,email,'. $id,
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

         $admin->name = $request->name;
         $admin->email = $request->email;

         if ($changePassword) {
         	$admin->password = bcrypt($request->password);
         }

         if ($request->has('profile') && $imageName) {
         	$admin->profile = $imageName;
         }

         $admin->save();
         return back()->with('success', 'Successfully update your profile.');

		// Save new information of the administrator.

	}
}
