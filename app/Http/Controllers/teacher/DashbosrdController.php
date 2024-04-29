<?php

namespace App\Http\Controllers\teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;

class DashbosrdController extends Controller
{
    public function index(){
        return view('teacher.teacher-dashboard');
    }

    public function logout(){
        Auth::guard('teacher')->logout();

        return redirect()->route('login');
    }

}
