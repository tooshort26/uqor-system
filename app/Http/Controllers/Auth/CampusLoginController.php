<?php

namespace App\Http\Controllers\Auth;

use App\Campus;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CampusLoginController extends Controller
{
    use AuthenticatesUsers;

	public function __construct()
	{
		$this->middleware('guest:campus')->except('logout');
	}

	public function login()
	{
		return view('campus.auth.login');
		
	}

    public function loginCampus(Request $request)
    {
    	 // Validate the form data
      $this->validate($request, [
        'email'   => 'required|email',
        'password' => 'required|min:6'
      ]);
      $isApproved = Campus::where('email', $request->email)->first(['approved']);

      if (!is_null($isApproved) && $isApproved->approved == 1) {
        // Attempt to log the user in
          if (Auth::guard('campus')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            // if successful, then redirect to their intended location
            return redirect()->intended(route('campus.dashboard'));
          } 
          // if unsuccessful, then redirect back to the login with the form data
          return redirect()->back()->withErrors(['message' => 'Please check your email/password.'])->withInput($request->only('email'));    
      } else {
        return redirect()->back()->withErrors(['message' => 'Please wait for the approval of administrator to your account.'])->withInput($request->only('email'));
      }

      
    }

    public function logout()
    {
        Auth::guard('campus')->logout();
        return redirect()->route('campus.auth.login');
    }
}
