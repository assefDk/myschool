<?php

namespace App\Http\Controllers\Api;

use App\Models\Mark;
use App\Models\Major;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Division;
use App\Models\TheClass;
use App\Models\Subject_Teacher;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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







    public function nodeStudent(){
        $nodes = Db::select('select * from notes where studentId = ?' ,[auth()->user()->studentId]);

        

        return response()->json([
            'status' => true,
            'data' => $nodes,
            'auth' =>auth()->user()->studentId
        ], 200);

    }


    public function HomeworkSudent(){
        $Homework = Db::select('select * from homework where 

            idS= ?' ,[auth()->user()->DivisionId]);


        return response()->json([
            'status' => true,
            'data' => $Homework,
            'auth' =>auth()->user()->studentId
        ], 200);

    }

    public function WeeklyScheduleSudent(){
        $WeeklySchedule = Db::select('select WeeklySchedule from divisions where 

            DivisionId= ?' ,[auth()->user()->DivisionId]);


        return response()->json([
            'status' => true,
            'data' => $WeeklySchedule,
            'auth' =>auth()->user()->studentId
        ], 200);

    }




    public function AnnouncmentStudent(){

        $announcments = Db::select('select * from announcments,announcments_divisions where

                announcments.status = "sstm" or  
                announcments.status = "sud" or
                announcments.IdAnnouncment = announcments_divisions.IdAnnouncment and
                announcments_divisions.DivisionId = ?' 
            ,[auth()->user()->DivisionId]);


        // $announcments = Db::select('select * from announcments where
        //     status = sstm 
        // ');


        return response()->json([
            'status' => true,
            'data' => $announcments,
            'auth' =>auth()->user()->studentId
        ], 200);

    }

















            
            









    // public function showsubjectStudent(){
        
            // $subjects = Db::select('select * from subjects , subject_teacher where
                //         subjects.belongs_to is null and
                //         subject_teacher.idS = subjects.idS and

                //         subject_teacher.DivisionId = ?' 
                //     ,[auth()->user()->DivisionId]);



            // $subjects = Subject::where('belongs_to', null)
            //     ->where('DivisionId', auth()->user()->DivisionId)
            //     ->whereIn('idS', function ($query) use ($mark) {
            //         $query->select('idS')
            //             ->from('subject_teacher')
            //             ->where('idS',$mark->subject_teacher->subject->idS);
            //     })
            //     ->get();






        // $subjects = Subject::where('belongs_to', null)
        //     ->where('ClassId', auth()->user()->ClassId)
        //     ->get();
        




            

        // $fulter = [
        //     'subject' => $subjects->sub_name,

        // ];

        // foreach($subjects as $s){
        //     $fulter[$s->idS] = $s->sub_name;
        // }
        


        public function showsubjectStudent()
        {
            $subjects = Subject::where('belongs_to', null)
                ->where('ClassId', auth()->user()->ClassId)
                ->get();
    
    
    
    
            return response()->json([
                'status' => true,
                'data' => $subjects,
                'auth' => auth()->user()->studentId
            ], 200);
        }
    
    
    
    
    
        public function showMarkStudent(Request $request)
        {
    
    
    
    
            $st = Student::find(auth()->user()->studentId);
            $div = $st->DivisionId;
            $subtea = Subject_Teacher::all()->where('idS', $request->idS)->where('DivisionId', $div)->first();
            $t = Teacher::all()->find($subtea->idT);
            $tname =  $t->firstname . " " . $t->lastname;
            $mark = Mark::all()->where('student_id', $st->studentId)->where('sub_tea_id', $subtea->sub_tea_id)->first();
            $subject = Subject::all()->find($request->idS);
           
    
    
    
            $mar = [
                ['mark' => $mark->homework, 'name' => "homework", 'mx' => $subject->max_homework,'max'=>$subject->max,'min'=>$subject->min,'teacher'=>$tname], ['mark' => $mark->in_class, 'name' => "in_class", 'mx' => $subject->max_in_class,'max'=>$subject->max,'min'=>$subject->min,'teacher'=>$tname], ['mark' => $mark->mid, 'name' => "mid", 'mx' => $subject->max_mid,'max'=>$subject->max,'min'=>$subject->min,'teacher'=>$tname], ['mark' => $mark->final, 'name' => "final", 'mx' => $subject->max_final,'max'=>$subject->max,'min'=>$subject->min,'teacher'=>$tname]
            ];
    
    
    
    
    
            //$mar = [$ma, $tname, ['max' => $subject->max, 'min' => $subject->min]];
    
    
    
    
            return response()->json([
                'status' => true,
                'data' => $mar,
                'auth' => auth()->user()->studentId
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
