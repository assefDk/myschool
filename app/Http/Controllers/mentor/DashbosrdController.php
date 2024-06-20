<?php

namespace App\Http\Controllers\mentor;

use Carbon\Carbon;
use App\Models\Mark;
use App\Models\note;
use App\Models\Major;
use App\Models\Mentor;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Division;
use App\Models\Announcment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;




class DashbosrdController extends Controller
{
    public function index(){
        return view('mentor.mentor-dashboard');
    }






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
        
        $n->creator = 'mentor ' . auth()->user()->firstname .' '. auth()->user()->lastname;
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


    // Announcment
    public function addAnnouncment(){

        $Majors = Major::all();
        return view('mentor.add-announcment',compact('Majors'));
    }


    public function processAddAnnouncment(Request $request){

        $test = false;
        if($request->has('teachers'))
        {
            $test = true;
            $anew =  new Announcment();

            $anew->creator = 'mentor ' . auth()->user()->firstname .' '. auth()->user()->lastname;
            $anew->title = $request->title;
            $anew->content = $request->content;
            $anew->Date_Created = Carbon::now();
            $anew->Expiry_date = $request->date;
            $anew->status  = 't';
    

            $anew->save();
        }


        if($request->division != "Select division")
        {
            $test = true;
            $anew =  new Announcment();

            $anew->creator = 'mentor ' . auth()->user()->firstname .' '. auth()->user()->lastname;
            $anew->title = $request->title;
            $anew->content = $request->content;
            $anew->Date_Created = Carbon::now();
            $anew->Expiry_date = $request->date;

            $anew->save();

            
            try {


                // البحث عن الصف
                $division = Division::findOrFail($request->division);

                $division->Announcment()->attach($anew);

            } catch (\Exception $e) {
                return 'حدث خطأ: ' . $e->getMessage();
            }
        }

        if($test){
            return redirect()->route("mentor.addAnnouncment")->with('success',"Added successfully Announcment");
        }else{
            return redirect()->route("mentor.addAnnouncment")->with('error',"Please enter correct information");
        }

    }


    public function showAnnouncment(){
        $Announcments = db::select('select * from announcments where 
            status = "m" or
            status = "sstm" 
        ');

        return view('mentor.show-announcment' ,compact('Announcments'));
    }



    //show student


    public function showStudents (Request $Request) {


        $divisionId=$Request->division;
        $classId=$Request->class;
      

        $lchecke = Mark::selectRaw('SUM(final) as finale, SUM(homework) as homeworke, SUM(mid) as mide')
        ->whereIn('sub_tea_id', function ($query) use ($divisionId, $classId) {
            $query->select('sub_tea_id')
                ->from('subject_teacher')
                ->where('DivisionId', $divisionId)
                ->whereIn('idS', function ($query) use ($classId) {
                    $query->select('idS')
                        ->from('subjects')
                        ->whereNull('belongs_to')
                        ->where('ClassId', $classId);
                });
        })
        ->get();
    $lcheck=$lchecke->first();
    if ($lcheck->mide==0&&$lcheck->finale==0)
       {
        $myquery=DB::select('select m.student_id,stu.firstName,stu.fathernName,stu.lastName , sum(m.in_class+m.homework) res from marks m  ,students stu
        where stu.studentId=m.student_id and  m.sub_tea_id in (select st.sub_tea_id from subject_teacher st 
        where
        st.DivisionId = ?
        and
           st.Subject_id in (select Subject_id from subjects
        where belongs_to is null and ClassId = ? ))
        GROUP by m.student_id,stu.firstName,stu.fathernName,stu.lastName 
        
        ',[$Request->division,$Request->class]);

        $mxe=Subject::selectRaw('SUM(max_in_class+max_homework) as mxe')
            ->whereNull('belongs_to')
            ->where('ClassId',$Request->class);
            $mx=$mxe->first()->mxe;
            $stat=1;

       }
       else
       {
        if ($lcheck->finale==0)
        {

            $myquery=DB::select('select m.student_id,stu.firstName,stu.fathernName,stu.lastName , sum(m.mid+m.in_class+m.homework) res from marks m  ,students stu
            where stu.studentId=m.student_id and  m.sub_tea_id in (select st.sub_tea_id from subject_teacher st 
            where
            st.DivisionId = ?
            and
               st.idS in (select Subject_id from subjects
            where belongs_to is null and ClassId = ? ))
            GROUP by m.student_id,stu.firstName,stu.fathernName,stu.lastName 
            
            ',[$Request->division,$Request->class]);

             $mxe=Subject::selectRaw('SUM(max_in_class+max_homework+max_mid) as mxe')
            ->whereNull('belongs_to')
            ->where('ClassId',$Request->class);
            $mx=$mxe->first()->mxe;
            $stat=2;
        }
        else
        {
            $myquery=DB::select('select m.student_id , stu.firstName, stu.fathernName , stu.lastName , sum(m.mid+m.in_class+m.homework+m.final) res from marks m  ,students stu
            where stu.studentId=m.student_id and  m.sub_tea_id in (select st.sub_tea_id from subject_teacher st 
            where
            st.DivisionId = ?
            and
            st.idS in (select idS from subjects
            where belongs_to is null and ClassId = ? ))
            GROUP by m.student_id,stu.firstName,stu.fathernName,stu.lastName 
        
            ',[$Request->division,$Request->class]);

        $mxe=Subject::selectRaw('SUM(max_in_class+max_homework+max_mid+max_final) as mxe')
            ->whereNull('belongs_to')
            ->where('ClassId',$Request->class);
            $mx=$mxe->first()->mxe;
            $stat=3;

        }

        }
        

        return view('mentor.get-students' , compact('myquery','mx'));
    
        }


    public function studentDetails ($id)
    {
        $student = Student::find($id);
        $marksn = $student->markn;

        return view('mentor.show-marks' , compact('student','marksn'));
    }


    public function isSeperated ($SubjectId) {
        $test = Subject::all()->where('belongs_to',$SubjectId);

        if ($test->first() == null)
            return false;
        else
            return true;    
    }


    public function markDetails ($markId) {
        $mark = Mark::find($markId);
        $major = $mark->student->major;

        if (DashbosrdController::isSeperated($mark->subject_teacher->subject->idS)){
            $seperatedM = Mark::select()->where('student_id',$mark->student_id)->whereIn('sub_tea_id', function ($query) use ($mark) {
                $query->select('sub_tea_id')
                    ->from('subject_teacher')
                    ->whereIn('idS', function ($query) use ($mark) {
                        $query->select('idS')
                            ->from('subjects')
                            ->where('belongs_to',$mark->subject_teacher->subject->idS);
                    });
            })->get();
        }
        else{
            $seperatedM = [];
        }
        return view('mentor.show-mark-details' , compact('mark','seperatedM'));
    }



    public function showMarks(){
        $Majors = Major::all();
        
        return view('mentor.show-all-marks' , compact('Majors'));
    }



}

