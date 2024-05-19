<?php

namespace App\Http\Controllers\mentor;

use Carbon\Carbon;
use App\Models\Major;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Mentor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use App\Models\note;




class DashbosrdController extends Controller
{
    public function index(){
        return view('mentor.mentor-dashboard');
    }





    public function fetchStudent($division){
        $students = DB::select('select * from students where DivisionId = ?', [$division]);

        return response()->json([
            'status' => 1,
            'students' => $students
        ]);

    }

    
    public function logout(){
        Auth::guard('mentor')->logout();

        return redirect()->route('login');
    }


    //Add Node
    public function showAddNote(){
        $Majors = Major::all();

        return view('mentor.add-note' , compact('Majors'));
    }
    public function ProcessAddNote(Request $request){
        
        
        $n = new note();
        
        $n->creator = auth()->user()->firstname .' '. auth()->user()->lastname;
        $n->content = $request->content;
        $n->Date_Created = Carbon::now();
        $n->studentId = $request->Student;

        $n->save();

        return redirect()->route('mentor.showAddNote')->with('success','The note was added successfully');



        // return $request;
    }


}
