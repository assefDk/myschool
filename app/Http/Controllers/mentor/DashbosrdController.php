<?php

namespace App\Http\Controllers\mentor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;

class DashbosrdController extends Controller
{
    public function index(){
        return view('mentor.mentor-dashboard');
    }



    public function logout(){
        Auth::guard('mentor')->logout();

        return redirect()->route('login');
    }

}
