<?php

namespace App\Http\Controllers\secretary;

use App\Models\Mark;
use App\Models\Major;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Division;
use App\Models\TheClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Subject_Teacher;
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

        return view('secretary.add-student' ,compact('Majors'));
    }


    //fetchs
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
    public function fetchSubject($ClassId){
        $Subject = DB::select('select * from subjects where ClassId = ?', [$ClassId]);

        return response()->json([
            'status' => 1,
            'Subject' => $Subject
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

            $d = $request->division;
            
            // dd($d);


            $subtea = db::select('select * from subject_teacher  where
                subject_teacher.DivisionId = ?
            ',[$d]);





            foreach($subtea as $s)
            {
                $mark = new Mark();
                $mark->student_id=$student->studentId;
                $mark->sub_tea_id=$s->sub_tea_id;
                $mark->save();

            }
            
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
    }

    public function processAddSubject(Request $request){

        // return $request;
        $validatot = Validator::make($request->all(), [
            'sub_name' => 'required',
            'max' => 'required',
            'min' => 'required',
            'max_mid' => 'required',
            'max_in_class' => 'required',
            'max_homework' => 'required',
            'max_final' => 'required',
            
        ]);

        $sum = $request->max_mid + $request->max_in_class + $request->max_homework + $request->max_final;

        if($validatot->passes() && $sum == $request->max){
            $subject = new Subject();
            $subject->sub_name = $request->sub_name; 
            $subject->max = $request->max; 
            $subject->min = $request->min; 
            $subject->ClassId = $request->class; 
            $subject->max_mid = $request->max_mid;
            $subject->max_in_class = $request->max_in_class;
            $subject->max_homework = $request->max_homework;
            $subject->max_final = $request->max_final;


            $subject->save();

            return redirect()->route("secretary.dashbosrd")->with('success','Added successfully Subject');
        }else{
            return redirect()->route("secretary.addSubject")->with('error','the input error');
        }

    }

    public function editsubject($id){
        $subject= Subject::all();
        $Majors = DB::select('select * from majors');

        //$subject2=$subject->where('Subject_id',$id)->first();
        $subject2= $subject->find($id);
            // return view('secretary.edit-subject',['subject'=>$subject->find($id)]);
            
            //$temp_subject=TheClass::where('ClassId',$subject2->ClassId)->first();
            return view('secretary.edit-subject',['subject'=>$subject2],compact('Majors'));
            
    }



    public function updatesubject(Request $request,$id){
        $validatot = Validator::make($request->all(), [
            'sub_name' => 'required',
            'max' => 'required',
            'min' => 'required', 
            //bruce
            'max_mid' => 'required',
            'max_in_class' => 'required',
            'max_homework' => 'required',
            'max_final' => 'required',
            
        ]);

        // $student->phone = $request->phone;
        $sum=$request->max_mid+$request->max_in_class+$request->max_homework+$request->max_final;

        if($validatot->passes() && $sum==$request->max){
            //end bruce
            $to_update = Subject::find($id);
            $to_update->sub_name = $request->sub_name; 
            $to_update->max = $request->max; 
            $to_update->min = $request->min; 
            //$to_update->ClassId = $request->class; 
            //bruce
            $to_update->max_mid=$request->max_mid;
            $to_update->max_in_class=$request->max_in_class;
            $to_update->max_homework=$request->max_homework;
            $to_update->max_final=$request->max_final;
            //end bruce

            $to_update->save();



            $subjects = DB::select('select * from the_classes c, subjects s where 
            s.ClassId = c.ClassId and
            s.ClassId = ?', [$to_update->ClassId]);


        return view('secretary.show-all-subject',compact('subjects'));


            // return redirect('secretary.ShowAllSubjectGet',$to_update->ClassId)->with('success',"edit successfully");
           // return redirect('secretary.ShowAllSubjectGet',$to_update->ClassId);

        }else{

            return redirect()->back()->withInput()->withErrors($validatot);
        }
    }

    public function destroysubject($id)
    {
        $to_delete=Subject::find($id);
        $to_delete->destroy($id);


        $subjects = DB::select('select * from the_classes c, subjects s where 
        s.ClassId = c.ClassId and
        s.ClassId = ?', [$to_delete->ClassId]);


        return view('secretary.show-all-subject',compact('subjects'))->with('success', 'subject deleted successfully.');
    }


    public function ShowSeperatingSubject () {
        $cls = DB::select('select * from the_classes');
        $Su = DB::select('select * from subjects');

        return view('secretary.Seperating_Subject',compact('cls','Su'));
    }

    public function SeperatingSubject(Request $request){
        
        $validatot = Validator::make($request->all(), [
            'sub_name' => 'required',
            'max' => 'required',
            'min' => 'required',
            'max_mid' => 'required',
            'max_in_class' => 'required',
            'max_homework' => 'required',
            'max_final' => 'required',
        ]);
    
        $sum=$request->max_mid+$request->max_in_class+$request->max_homework+$request->max_final;

        if($validatot->passes() && $sum==$request->max){
            $subject = new Subject();
            $subject->sub_name = $request->sub_name; 
            $subject->max = $request->max; 
            $subject->min = $request->min; 
            $subject->ClassId = $request->cls; 
            $subject->max_mid=$request->max_mid;
            $subject->max_in_class=$request->max_in_class;
            $subject->max_homework=$request->max_homework;
            $subject->max_final=$request->max_final;
            $subject->belongs_to=$request->Subject;
            $subject->save();


            // return 'success';
            // return redirect()->route("secretary.addSubject")->withInput()->withErrors($validatot);
            return redirect()->route("secretary.dashbosrd")->with('success','Added successfully Subject');
        }else{
            return redirect()->route("secretary.addSubject")->withInput()->withErrors($validatot);
        }
    }



    // end













    public function SelectClass(){
        $Majors = DB::select('select * from majors');
        return view('secretary.SelectClass',compact('Majors'));
    }
    public function ShowAllSubject(Request $request){

        $subjects = DB::select('select * from the_classes c, subjects s where 
            s.ClassId = c.ClassId and
            s.ClassId = ?', [$request->class]);


        return view('secretary.show-all-subject',compact('subjects'));
    }



    //ShowConnectingTeacherWithSubject
    public function ShowConnectingTeacherWithSubject(Request $request){
        // $Subjects = Subject::select('idS','sub_name')->get();
        $Teachers = Teacher::select('idT','firstname','lastname')->get();
        $Majors = Major::select('MajorId','name')->get();


        return view('secretary.Connecting_teacher_with_Subject',compact('Teachers','Majors'));
    }



    public function ConnectingTeacherWithSubject(Request $request)
    {



    try {

        $st = new Subject_Teacher();
        
        $st->idT = $request->Teacher;
        $st->idS = $request->Subjects;
        $st->DivisionId = $request->division;
        $st->save();


        return 'تم بنجاح';
    } 
    catch (\Exception $e) {
            return 'حدث خطأ: ' . $e->getMessage();
    }











    // try {
            // البحث عن المعلم
            // $subject = Subject::findOrFail($request->Subjects);

            // // البحث عن الصف
            // $division = Division::findOrFail($request->division);
    
            // // البحث عن المواد
            // $teachers = Teacher::findOrFail($request->Teacher);
    
            // // إرفاق المعلم بالمواد
            // $subject->Teachers()->attach($teachers);
            // $division->Teachers()->attach($teachers);


    
        //     return 'تم بنجاح';
        // } catch (\Exception $e) {
        //     return 'حدث خطأ: ' . $e->getMessage();
        // }
    // }   







    }



    public function showAnnouncment(){
        $Announcments = db::select('select * from announcments where 
            status = "se" or
            status = "sstm" 
        ');

        return view('secretary.show-announcment' ,compact('Announcments'));
    }



}
