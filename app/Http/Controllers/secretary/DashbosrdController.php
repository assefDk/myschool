<?php

namespace App\Http\Controllers\secretary;

use App\Models\Student;
use App\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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

        // $Classes = DB::select('select * from the_classes');

        // $Divisions = DB::select('select * from divisions');

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
                'studentStatus' => 'required',
                'gender' => 'required',
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
                $student->studentStatus = $request->studentStatus;
                $student->gender = $request->gender;
                $student->save();
                
                // $student->createToken("API TOKEN")->plainTextToken;
    
                Auth::guard('student')->login($student);

    
                return redirect()->route("secretary.dashbosrd")->with('success','Added successfully Student');

            }else{

                return redirect()->route("secretary.addStudent")->withInput()->withErrors($validatot);
            }

        } 

}
