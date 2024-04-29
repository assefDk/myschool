<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;

class LoginController extends Controller
{
    public function index(){
        return view('login');
    }




    public function authenticate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ]);
    
        if ($validator->passes()) {

            if (Auth::guard('secretary')->attempt(['username' => $request->username, 'password' => $request->password , 'isadmin' => 1])) {
                // Auth::guard('secretary')->login();
                return redirect()->route('admin.dashboard');
            }

            elseif(Auth::guard('secretary')->attempt(['username' => $request->username, 'password' => $request->password])) {
                return redirect()->route('secretary.dashbosrd');
            }

            elseif(Auth::guard('teacher')->attempt(['username' => $request->username, 'password' => $request->password])){
                return redirect()->route('teacher.dashbosrd');
            }

            elseif(Auth::guard('mentor')->attempt(['username' => $request->username, 'password' => $request->password])){
                return redirect()->route('mentor.dashbosrd');
            }
            else {
                return redirect()->route('login')->with('error', 'إما أن البريد الإلكتروني أو كلمة المرور غير صحيحة');
            }
        } else {
            return redirect()->route('login')->withInput()->withErrors($validator);
        }
    }



    // if(Auth::guard('admin')->user()->role != "admin"){
    //     Auth::guard('admin')->logout();
    //     return redirect()->route('admin.login')->with('error', 'you are not authorized to access this page');
    // }


}
