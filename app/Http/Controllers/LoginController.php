<?php

namespace App\Http\Controllers;

use App\Models\Mentor;
use App\Models\Secretary;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

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

            if (Auth::guard('admin')->attempt(['username' => $request->username, 'password' => $request->password , 'isadmin' => 1])) {
                // Auth::guard('secretary')->login();
                $userMentor = Secretary::where('username',$request->username)->first();
                $token = $userMentor->createToken("API TOKEN")->plainTextToken;
                
                return redirect()->route('admin.dashboard' , ['token' => $token]);
            }

            elseif(Auth::guard('secretary')->attempt(['username' => $request->username, 'password' => $request->password])) {
                $userMentor = Secretary::where('username',$request->username)->first();
                $token = $userMentor->createToken("API TOKEN")->plainTextToken;

                return redirect()->route('secretary.dashbosrd',['token' => $token]);
            }

            elseif(Auth::guard('teacher')->attempt(['username' => $request->username, 'password' => $request->password])){
                $userMentor = Teacher::where('username',$request->username)->first();
                $token = $userMentor->createToken("API TOKEN")->plainTextToken;

                return redirect()->route('teacher.dashbosrd' ,['token' => $token]);
            }

            elseif(Auth::guard('mentor')->attempt(['username' => $request->username , 'password' => $request->password])){
                $userMentor = Mentor::where('username',$request->username)->first();
                $token = $userMentor->createToken("API TOKEN")->plainTextToken;

                return redirect()->route('mentor.dashbosrd', ['token' => $token]);
            }
            else {
                return redirect()->route('login')->with('error', 'إما أن اسم المستخدم أو كلمة المرور غير صحيحة');
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
