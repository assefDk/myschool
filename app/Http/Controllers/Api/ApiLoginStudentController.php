<?php

namespace App\Http\Controllers\Api;

use App\Models\Student;
use App\Models\TheClass;
use App\Models\Major;
use App\Models\Division;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

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







    
    




    //befor profileStudent
    // public function profileStudent()
    // {
    //     // Retrieve the authenticated user's profile data
    //     // $studentData = auth()->guard('student')->user();
    //     $studentData = auth()->user();
    
    //     // Return a JSON response with the profile information
    //     return response()->json([
    //         'status' => true,
    //         'message' => 'Profile information',
    //         'data' => $studentData,
    //         'id' => auth()->user()->studentId
    //     ], 200);
    // }


    // after profileStudent
    public function profileStudent()
    {
        // $studentData = auth()->guard('student')->user();
        $studentData = auth()->user();

        $className = TheClass::where(['ClassId' => $studentData->ClassId ])->first();
        $majorName = Major::where(['MajorId' => $studentData->MajorId ])->first();
        $Division = Division::where(['DivisionId' => $studentData->DivisionId ])->first();

        

        $newData = [
            'studentId' => $studentData->studentId,
            'username' =>  $studentData->username,
            'password' =>  $studentData->password,
            'firstName' =>  $studentData->firstName,
            'lastName' =>  $studentData->lastName,
            'phone' =>  $studentData->phone,
            'address' =>  $studentData->adress,
            'email' =>  $studentData->email,
            'birthdate' =>  $studentData->birthdate,
            'fathernName' =>  $studentData->fathernName,
            'motherName' =>  $studentData->motherName,
            'gender' =>  $studentData->gender,
            'major' =>  $majorName->name,
            'className' =>  $className->ClassName,
            'Division' =>  $Division->Numberdvs,
            'created_at' =>  $studentData->created_at,
            'updated_at' =>  $studentData->updated_at,
        ];

        return response()->json([
            'status' => true,
            'message' => 'Profile information',
            'data' => $newData,
            'id' => auth()->user()->studentId
        ], 200);
    }







    public function nodeSudent(){
        $nodes = Db::select('select * from notes where studentId = ?' ,[auth()->user()->studentId]);

        

        return response()->json([
            'status' => true,
            'data' => $nodes,
            'auth' =>auth()->user()->studentId
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
