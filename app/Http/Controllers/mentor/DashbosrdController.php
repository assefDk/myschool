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
use App\Models\Division;




class DashbosrdController extends Controller
{
    public function index(){
        $Division = Division::all();
        // OR
        // $Division = Division::get();
        return view('mentor.mentor-dashboard',compact('Division'));




        // return view('mentor.mentor-dashboard');
    }

    // public function dashbosrdfake($id){
    //     $we = Division::findOrFail($id);
    //     $im = $we->getFirstMedia('WeeklySchedule');


    // }





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

    }




    public function addWeeklySchedule(){
        $Majors = Major::all();

        return view('mentor.add-WeeklySchedule',compact('Majors'));
    }

    public function ProcessAddWeeklySchedule(Request $request){

        $validatot = Validator::make($request->all(), [
            'class' => 'required',
            'division' => 'required',
            'image' => 'required | mimes:png,jpg,jpeg,webp',
        ]);





        if($validatot->passes()){
            if($request->has('image')){
                $file = $request->file("image");
                $extension = $file->getClientOriginalExtension();

                $fileName = time().'.'.$extension;

                $Path = 'WeeklySchedule/';
                $file->move($Path, $fileName);


                $Division = Division::find($request->division);
                $Division->update(['WeeklySchedule' => $Path.$fileName]);

            }

            return redirect()->route("mentor.dashbosrd")->with('success',"Added successfully WeeklySchedule");
        }
        return redirect()->route("mentor.addWeeklySchedule")->withInput()->withErrors($validatot);

    }


}

