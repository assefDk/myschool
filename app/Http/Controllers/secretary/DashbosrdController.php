<?php

namespace App\Http\Controllers\secretary;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Student;

class DashbosrdController extends Controller
{
    public function index(){
        return view('secretary.secretary-dashboard');
    }
    public function addStudent(){
        return view('secretary.add-student');
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
