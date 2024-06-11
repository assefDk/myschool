<?php

namespace App\Http\Controllers\teacher;

use Carbon\Carbon;
use App\Models\Major;
use App\Models\Student;
use App\Models\Division;
use App\Models\Homework;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class DashbosrdController extends Controller
{
    public function index(){
        return view('teacher.teacher-dashboard');
    }

    public function logout(){
        
        Auth::guard('teacher')->logout();
        return redirect()->route('login');
    }

    public function addHomework(){
        // $Majors = Major::all();

        $a = auth()->user()->idT;

        $Majors = DB::select('select * from majors , the_classes , subjects ,teachers ,subject_teacher
            where 
            majors.MajorId = the_classes.MajorId and

            the_classes.ClassId = subjects.ClassId and

            subject_teacher.idT = teachers.idT and  
            subject_teacher.idS = subjects.idS and

            subject_teacher.idT = ?
        ',[$a]);





        return view('teacher.add-homework' ,compact('Majors'));

    }






    //____________________fetchs__________________
    public function fetchClass($MajorId){

        $a = auth()->user()->idT;

        $Classes = DB::select('select  * from the_classes , subject_teacher, subjects ,teachers ,majors
        where
        the_classes.ClassId = subjects.ClassId and


        subject_teacher.idS = subjects.idS and
        subject_teacher.idT = teachers.idT and     




        majors.MajorId = the_classes.MajorId and
        majors.MajorId = ? and


        subject_teacher.idT = ? ',[$MajorId, $a]);




        return response()->json([
            'status' => 1,
            'Classes' => $Classes
        ]);

    }


    
    public function fetchDivision($ClassId){

        $a = auth()->user()->idT;

        $division = DB::select('select  * from the_classes , subject_teacher, divisions_teachers , subjects ,teachers ,divisions
        where
        the_classes.ClassId = subjects.ClassId and

        subject_teacher.idS = subjects.idS and
        subject_teacher.idT = teachers.idT and     


        the_classes.ClassId = divisions.ClassId and
        the_classes.ClassId = ? and


        divisions_teachers.idT = teachers.idT and 
        divisions_teachers.DivisionId = divisions.DivisionId and

        divisions_teachers.idT = ? and 
        
        subject_teacher.idT = ? ',[$ClassId,$a,$a]);


        return response()->json([
            'status' => 1,
            'Division' => $division
        ]);

    }



    public function fetchSubject($div){

        $a = auth()->user()->idT;

        $Subject = DB::select('select  * from  subjects , the_classes , divisions ,teachers ,subject_teacher , divisions_teachers
            where
            the_classes.ClassId =  subjects.ClassId and
            the_classes.ClassId = subjects.ClassId and


            subject_teacher.idS = subjects.idS and
            subject_teacher.idT = teachers.idT and 


            
            divisions_teachers.idT = teachers.idT and 
            divisions_teachers.DivisionId = divisions.DivisionId and



            divisions.DivisionId = ? and

            subject_teacher.idT = ?',[$div,$a]);



        return response()->json([
            'status' => 1,
            'Subject' => $Subject
        ]);

    }

    

    public function ProcessAddHomework(Request $request){

        $validatot = Validator::make($request->all(), [
            'Major' => 'required',
            'class' => 'required',
            'division' => 'required',
            'Subject' => 'required',
            'file' => 'required | mimes:doc,docx,txt,pdf,json,xls',
            'endDate' => 'required'    
        ]);


        $sub = Subject::select('sub_name')->where('idS',$request->Subject)->get();


        $sub = Subject::select('sub_name')->where('idS', $request->Subject)->first();
        $subName = $sub->sub_name;



        if($validatot->passes()){
            if($request->has('file')){
                $file = $request->file("file");
                $Path = "uploads";
                $extension = $file->getClientOriginalExtension();
                $fileName = time().'.'.$extension;
                $file->move($Path, $file->getClientOriginalName());

                Homework::create([
                    'creator' => auth()->user()->firstname .' '. auth()->user()->lastname,
                    'file' => $Path.$fileName,
                    'subject' => $subName,
                    'startHomework' => Carbon::now(),
                    'endHomework' => $request->endDate,
                    'idS' => $request->Subject

                ]);

            }

            return redirect()->route("teacher.addHomework")->with('success',"Added successfully Homework");
        }
        return redirect()->route("teacher.addHomework")->withInput()->withErrors($validatot);
    }




    // Announcment
    public function addAnnouncment(){
        return view('teacher.add-announcment');
    }


}
