<?php

namespace App\Http\Controllers\teacher;

use Carbon\Carbon;
use App\Models\Mark;
use App\Models\note;
use App\Models\Major;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Division;
use App\Models\Homework;
use App\Models\Announcment;
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
        $a = auth()->user()->idT;

        



        $Majors = DB::select('select * from majors , the_classes
            where 
        the_classes.MajorId=majors.MajorId AND
                the_classes.ClassId in (select ClassId from subjects 
                    WHERE
                    idS in (
                    select idS from subject_teacher
                        WHERE idT = ?
                    
                    ))
                
                ',[$a]);


        return view('teacher.add-homework' ,compact('Majors'));

    }






    //____________________fetchs__________________
    public function fetchClass($MajorId){

        $a = auth()->user()->idT;


        $Classes = DB::select('select * from the_classes 
                        WHERE
                        the_classes.MajorId = ? AND
                        the_classes.ClassId in (SELECT ClassId from subjects 
                        WHERE subjects.idS in (SELECT idS from subject_teacher 
                        WHERE idT = ?))
        ',[$MajorId,$a]);



        // $Classes = DB::select('select  * from the_classes , subject_teacher, subjects ,teachers ,majors
        // where
        // the_classes.ClassId = subjects.ClassId and


        // subject_teacher.idS = subjects.idS and
        // subject_teacher.idT = teachers.idT and     




        // majors.MajorId = the_classes.MajorId and
        // majors.MajorId = ? and


        // subject_teacher.idT = ? ',[$MajorId, $a]);




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


    public function fetchStudent($division){
        $students = DB::select('select * from students where DivisionId = ?', [$division]);

        return response()->json([
            'status' => 1,
            'students' => $students
        ]);

    }






    public function fetchSubject($div){

        $a = auth()->user()->idT;

        $Subject = DB::select('select  * from  subjects , the_classes , divisions ,teachers ,subject_teacher 
            where
            the_classes.ClassId =  subjects.ClassId and
            the_classes.ClassId = subjects.ClassId and


            subject_teacher.idS = subjects.idS and
            subject_teacher.idT = teachers.idT and 


            
            subject_teacher.DivisionId = divisions.DivisionId and

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
        
        
        $a = auth()->user()->idT;

        $Majors = DB::select('select * from majors , the_classes
        where 
    the_classes.MajorId=majors.MajorId AND
            the_classes.ClassId in (select ClassId from subjects 
                WHERE
                idS in (
                select idS from subject_teacher
                    WHERE idT = ?
                
                ))
            
            ',[$a]);

        return view('teacher.add-announcment' ,compact('Majors'));
    }


    public function processAddAnnouncment(Request $request){

        $anew =  new Announcment();



        $anew->creator = 'teacher ' . auth()->user()->firstname .' '. auth()->user()->lastname;
        $anew->title = $request->title;
        $anew->content = $request->content;
        $anew->Date_Created = Carbon::now();
        $anew->Expiry_date = $request->date;

        $anew->save();

        
        try {


            // البحث عن الصف
            $division = Division::findOrFail($request->division);

            $division->Announcment()->attach($anew);

            return 'تم بنجاح';

        } catch (\Exception $e) {
            return 'حدث خطأ: ' . $e->getMessage();
        }

        // return $request;
    }
    public function showAnnouncment(){
        $Announcments = db::select('select * from announcments where 
            status = "t" or
            status = "sstm" 
        ');

        return view('teacher.show-announcment' ,compact('Announcments'));
    }










    //  Node
    public function addNode(){

        $teacher = auth()->user()->idT;


        $Majors = DB::select('select * from majors , the_classes
        where 
        the_classes.MajorId=majors.MajorId AND
                the_classes.ClassId in (select ClassId from subjects 
                    WHERE
                    idS in (
                    select idS from subject_teacher
                        WHERE idT = ?
                    
                    ))
            
            ',[$teacher]);


        return view('teacher.add-note', compact('Majors'));
    }





    public function ProcessAddNodet(Request $request){
        
        
        $n = new note();
        
        $n->creator = 'teacher ' . auth()->user()->firstname .' '. auth()->user()->lastname;
        $n->content = $request->content;
        $n->Date_Created = Carbon::now();
        $n->studentId = $request->Student;

        $n->save();

        return redirect()->route('teacher.addNode')->with('success','The note was added successfully');

    }





    //bruce

    public function showaddMark () {
        $teacher = auth()->user()->idT;
        
        $Majors = DB::select('select * from majors , the_classes
        where 
        the_classes.MajorId=majors.MajorId AND
                the_classes.ClassId in (select ClassId from subjects 
                    WHERE
                    idS in (
                    select idS from subject_teacher
                        WHERE idT = ?
                    
                    ))
            
            ',[$teacher]);

        return view('teacher.show-add-mark' , compact('Majors'));
    }
    public function addMark(Request $request){
    
        $mark = Mark::all();
        $markk = $mark->where('student_id',$request->student_id);
        $marke = $markk->where('sub_tea_id',$request->sub_tea)->first();
        $subt = DB::table('subject_teacher')->get();
        $subtt = $subt->where('sub_tea_id',$request->sub_tea)->first();
        
        $mxx = Subject::find($subtt->idS);
        return view('teacher.add-mark' , ['mark'=>$marke,'mx'=>$mxx]);
    }

    public function ProcessAddMark (Request $request,$id){
        $validatot = Validator::make($request->all(), [
            'mid' => 'required',
            'in_class'=> 'required',
            'homework'=> 'required',
            'final' => 'required',
        ]);
        $mark = Mark::find($id);

        $subt = DB::table('subject_teacher')->get();
        $subtt = $subt->where('sub_tea_id',$mark->sub_tea_id)->first();
        $mx = Subject::find($subtt->idS);
        

        

        $tst = false;
        if ($request->input('mid')<=$mx->max_mid && $request->input('in_class')<=$mx->max_in_class&&
            $request->input('homework')<=$mx->max_homework&&$request->input('final')<=$mx->max_final)
        {
            $tst=true;
        }
        else  $msg="Please enter check max values ";
        
        if($validatot->passes() && $tst){
                $to_update = Mark::find($id);
                $to_update->mid=strip_tags($request->input('mid'));
                $to_update->in_class=strip_tags($request->input('in_class'));
                $to_update->homework=strip_tags($request->input('homework'));
                $to_update->final=strip_tags($request->input('final'));
                
            $to_update->save();
            return redirect()->route("teacher.showaddMark")->with('success',"added successfully");
        }
        return redirect()->back()->withInput()->withErrors($validatot)->withMessage($msg);

    }

    //end bruce




    public function fetchsubtea($stdc){
        $std=Student::all()->find($stdc);
        $cl=$std->ClassId;
        $div=$std->DivisionId;
        $sub_tea=DB::select('select st.sub_tea_id , s.sub_name , t.firstname , t.lastname  from subject_teacher st , subjects s , teachers t  
        where
            st.idS = s.idS and
            st.idT = t.idT and
            s.ClassId = ?  and
            st.DivisionId = ?'

        ,[$cl,$div]);




        return response()->json([
            'status' => 1,
            'subjectt' => $sub_tea
        ]);
    }










}
