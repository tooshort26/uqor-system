<?php

namespace App\Http\Controllers\Campus;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CampusRegisterRequest;
use App\Campus;
use Auth;

class CampusRegisterController extends Controller
{
    public function create()
    {
    	return view('campus.auth.register');
    }

    public function store(CampusRegisterRequest $request)
    {
         $campus = Campus::where(['name' => $request->name, 'role' => $request->role])->exists();
         if ($campus) {
             // Return to register page with Error message
            return redirect()->back()->withErrors(['message' => 'This campus with ' . $request->role . ' role is already register.'])->withInput($request->all());
         }
    	 Campus::create($request->all());
        // If succesfully register display message for approval
         return view('campus.auth.success-message');
    }
}
