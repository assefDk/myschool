<?php

namespace App\Http\Controllers\admin;

use App\Models\Mentor;
use App\Models\Teacher;
use App\Models\Secretary;
use App\Models\Division;
use App\Models\Major;
use App\Models\TheClass;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{


    //The Method Added Secretary
    public function addsecretary(){
        return view("admin.add-secrutary");
    }
    public function processaddsecretary(Request $request){

        $validatot = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname'=> 'required',
            'username'=> 'required',
            'password' => 'required',
            // 'phone'=> 'required|unique',
            'phone'=> 'required',
            'address'=> 'required',
            'email' => 'required|email|unique:users',
            'birthdate'=> 'required',
            'fathername'=> 'required',
            'mothername'=> 'required',
            'gender'=> 'required',
        ]);

        if($validatot->passes()){
            $user = new Secretary();
            $user->firstname = $request->firstname;
            $user->lastname = $request->lastname;
            $user->username = $request->username;
            $user->password = Hash::make($request->password); 
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->email = $request->email;
            $user->birthdate = $request->birthdate;
            $user->fathername = $request->fathername;
            $user->mothername = $request->mothername;
            $user->gender = $request->gender;
            $user->save();


            Auth::guard('secretary')->login($user);
            // Auth::guard('secretary')->user()->getAuthPasswordName();
            // Auth::loginUsingId(1);

            return redirect()->route("admin.dashboard")->with('success','Added successfully secretary');
            
        }else{

            return redirect()->route("admin.addsecretary")->withInput()->withErrors($validatot);

        }
        
    }
    public function showallsecretary(){
        $user = Secretary::all();



        return view('admin.show-all-secretary',compact('user'));
    }







    //The Method Added Teacher
    public function addteacher(){
        return view("admin.add-teacher");
    }
    public function processaddteacher(Request $request){

        $validatot = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname'=> 'required',
            'username'=> 'required',
            'password' => 'required',
            // 'phone'=> 'required|unique',
            'phone'=> 'required',
            'address'=> 'required',
            'email' => 'required|email|unique:users',
            'birthdate'=> 'required',
            'fathername'=> 'required',
            'mothername'=> 'required',
            'gender'=> 'required',
        ]);

        if($validatot->passes()){
            $user = new Teacher();
            $user->firstname = $request->firstname;
            $user->lastname = $request->lastname;
            $user->username = $request->username;
            $user->password = Hash::make($request->password); 
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->email = $request->email;
            $user->birthdate = $request->birthdate;
            $user->fathername = $request->fathername;
            $user->mothername = $request->mothername;
            $user->gender = $request->gender;
            $user->save();

            Auth::guard('teacher')->login($user);

            return redirect()->route("admin.dashboard")->with('success','Added successfully teacher');
            
        }else{

            return redirect()->route("admin.addteacher")->withInput()->withErrors($validatot);

        }
    }
    public function showallteacher(){

        $user = Teacher::all();
        return view('admin.show-all-teacher',compact('user'));

    }
    









    //The Method Added Mentor
    public function addmentor(){
        return view("admin.add-mentor");
    }

    public function processaddmentor(Request $request){

        $validatot = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname'=> 'required',
            'username'=> 'required',
            'password' => 'required',
            // 'phone'=> 'required|unique',
            'phone'=> 'required',
            'address'=> 'required',
            'email' => 'required|email|unique:users',
            'birthdate'=> 'required',
            'fathername'=> 'required',
            'mothername'=> 'required',
            'gender'=> 'required',
        ]);

        if($validatot->passes()){
            $user = new Mentor();
            $user->firstname = $request->firstname;
            $user->lastname = $request->lastname;
            $user->username = $request->username;
            $user->password = Hash::make($request->password); 
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->email = $request->email;
            $user->birthdate = $request->birthdate;
            $user->fathername = $request->fathername;
            $user->mothername = $request->mothername;
            $user->gender = $request->gender;
            $user->save();


            Auth::guard('mentor')->login($user);

            return redirect()->route("admin.dashboard")->with('success','Added successfully mentor');
            
        }else{

            return redirect()->route("admin.addmentor")->withInput()->withErrors($validatot);

        }
    }
    public function showallmentor(){
        $user = Mentor::all();
        return view('admin.show-all-mentor',compact('user'));
    }


    //add class
    public function addclass(){
        $dv =  Division::all();
        $cl = TheClass::all();


        return view("admin.add-class",compact('dv','cl'));
    }    
    public function showallclass(){
        $classes = DB::select('select * from  the_classes c,divisions d, majors m
        where 
        c.MajorId = m.MajorId 
        and c.ClassId = d.ClassId 
        ');


        // the_classes::where('');


        return view('admin.show-all-class',compact('classes'));
    }    



}
