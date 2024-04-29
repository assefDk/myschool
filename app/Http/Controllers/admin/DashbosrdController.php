<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;

class DashbosrdController extends Controller
{
    public function index(){
        return view('admin.admin-dashboard');
    }


    public function logout(){
        Auth::guard('secretary')->logout();

        return redirect()->route('login');
    }


}
