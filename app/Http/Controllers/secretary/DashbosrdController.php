<?php

namespace App\Http\Controllers\secretary;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Subject;
use App\Models\Division;
use App\Models\Major;
use App\Models\TheClass;

class DashbosrdController extends Controller
{
    public function index(){
        return view('secretary.secretary-dashboard');
    }

    public function logout(){
        Auth::guard('secretary')->logout();
        
        return redirect()->route('login');
    }

    public function addStudent(){
        $Majors = DB::select('select * from majors');

        return view('secretary.add-student' ,compact('Majors'));
    }


    public function fetchClass($MajorId){
        $Classes = DB::select('select * from the_classes where MajorId = ?', [$MajorId]);



        return response()->json([
            'status' => 1,
            'Classes' => $Classes
        ]);

    }

    public function fetchDivision($ClassId){
        $division = DB::select('select * from divisions where ClassId = ?', [$ClassId]);

        return response()->json([
            'status' => 1,
            'Division' => $division
        ]);

    }

    public function processAddStudent(Request $request){

        $validatot = Validator::make($request->all(), [
            'username' => 'required|unique:students',
            'password' => 'required',
            'email'=> 'required|email|unique:students,email',
            'firstName' => 'required',
            'lastName' => 'required',
            'phone' => 'required',
            'adress' => 'required',
            'birthdate' => 'required',
            'fathernName' => 'required',
            'motherName' => 'required',
            'gender' => 'required',

            
            // 'MajorId' => 'required',
            // 'ClassId' => 'required',
            // 'DivisionId' => 'required',

        ]);

        if($validatot->passes()){
            $student = new Student();
            $student->username = $request->username;
            $student->password = Hash::make($request->password); 
            $student->email = $request->email;
            $student->firstName = $request->firstName;
            $student->lastName = $request->lastName;
            $student->phone = $request->phone;
            $student->adress = $request->adress;
            $student->birthdate = $request->birthdate;
            $student->fathernName = $request->fathernName;
            $student->motherName = $request->motherName;
            $student->gender = $request->gender;
            
            $student->MajorId = $request->Majors;
            $student->ClassId = $request->class;
            $student->DivisionId = $request->division;
            $student->save();
            
            // $student->createToken("API TOKEN")->plainTextToken;

            Auth::guard('student')->login($student);


            return redirect()->route("secretary.dashbosrd")->with('success','Added successfully Student');

        }else{

            return redirect()->route("secretary.addStudent")->withInput()->withErrors($validatot);
        }

    } 





    //Add Subject
    public function addSubject(){
        $Majors = DB::select('select * from majors');
        return view('secretary.add-Subject' ,compact('Majors'));
        // return view('secretary.add-Subject');
    }

    public function processAddSubject(Request $request){
        $validatot = Validator::make($request->all(), [
            'sub_name' => 'required',
            'max' => 'required',
            'min' => 'required',
            // 'ClassId' => 'required',
        ]);

        // $student->phone = $request->phone;
        if($validatot->passes()){
            $subject = new Subject();
            $subject->sub_name = $request->sub_name; 
            $subject->max = $request->max; 
            $subject->min = $request->min; 
            $subject->ClassId = $request->class; 


            $subject->save();

            return redirect()->route("secretary.dashbosrd")->with('success','Added successfully Subject');

        }else{

            return redirect()->route("secretary.addSubject")->withInput()->withErrors($validatot);
        }
    }
    public function showAllSubject(){
        $Majors = DB::select('select * from majors');
        return view('secretary.show-alll-subject',compact('Majors'));
    }


    public function SubjectInClass(){
        $Subjects  = Subject::all();
        
        return redirect()->route("secretary.addSubject", compact('Subjects'));
    }








}
