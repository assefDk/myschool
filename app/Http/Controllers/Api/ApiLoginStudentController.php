<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Student;

class ApiLoginStudentController extends Controller
{
    public function loginStudent(Request $request){
        try{

            $validateUser = Validator::make($request->all(),[
                'username'=> 'required',
                'password' => 'required'
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ],401);
            }

            if(!Auth::guard('student')->attempt($request->only(['username','password']))){
                return response()->json([
                    'status' => false,
                    'message' => 'username & password does not mathch our record.',
                ],401);
            }

            $userStudent = Student::where('username',$request->username)->first();
            return response()->json([
                'status' => true,
                'message' => 'Student Logged In Successfully',
                'token' => $userStudent->createToken("API TOKEN")->plainTextToken
            ],200);

        } catch(\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ],500);
        }
        
    }
    //3|Icqle1MhBKpwHw7fVrV9aQaia8okMjeOzkZ3BiINabf329cf







    
    public function profileStudent()
    {
        // Retrieve the authenticated user's profile data
        // $studentData = auth()->guard('student')->user();
        $studentData = auth()->user();
    
        // Return a JSON response with the profile information
        return response()->json([
            'status' => true,
            'message' => 'Profile information',
            'data' => $studentData,
            'id' => auth()->user()->studentId
        ], 200);
    }


    public function logoutStudent()
    {
        // Delete all tokens associated with the authenticated user
        //true this
        auth()->user()->tokens()->delete(); 

        // Return a JSON response indicating successful logout
        return response()->json([
            'id' => auth()->user()->studentId,
            'status' => true,
            'message' => 'Student logged out',
            'data' => [],
        ], 200);
    }



}
