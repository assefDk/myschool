<?php

namespace App\Http\Controllers\secretary;
use Carbon\Carbon;

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
        $subjects=Subject::all()->where('ClassId',$request->class);
        $sub_tea=Subject_Teacher::all()->where('DivisionId',$request->division);
        foreach($subjects as $subject)
        {
            if($sub_tea->where('idS',$subject->idS)->first()==null)
            {$messag="sorry but the subject " .$subject->sub_name ." is not connected to a teacher in this division";
            return redirect()->route("secretary.addStudent")->with('error',$messag);}
           //cheking if there is a subject that is not independent and it needs to add subject belonged to it to complete max
           if (app('App\Http\Controllers\mentor\DashbosrdController')->isSeperated($subject->idS))
           {
            $seperated=Subject::all()->where('belongs_to',$subject->idS);
            $maxs=0;
            $homeworks=0;
            $mids=0;
            $in_classs=0;
            $finals=0;
            foreach($seperated as $sep)
            {
                $maxs+=$sep->max;
                $homeworks+=$sep->max_homework;
                $mids+=$sep->max_mid;
                $in_classs+=$sep->max_in_class;
                $finals+=$sep->max_final;


            }
              if($maxs<$subject->max
                &&$homeworks<$subject->max_homework 
                &&$mids<$subject->max_mid 
                &&$in_classs<$subject->max_in_class 
                &&$finals<$subject->max_final 
                ) {return redirect()->route("secretary.addStudent")->with('error',"sorry but the subject : " .$subject->sub_name ." needs to be seperated once or so to proceed"); }
  
              
           }   
        }



        $checkdate = Carbon::parse($request->birthdate);
        
        $now = Carbon::now();
        $valid=false;
        if ($checkdate->diffInYears($now) >= 5 && (!preg_match('/[0-9]/', $request->firstName))
        && (!preg_match('/[0-9]/', $request->lastName))
        &&(!preg_match('/[0-9]/', $request->fathernName))
        &&(!preg_match('/[0-9]/', $request->motherName))
        &&(!preg_match('/[!@#$%^&*()-_=+{}:;\|~`?.>,<\/\'"[\]]/', $request->firstName))
        &&(!preg_match('/[!@#$%^&*()-_=+{}:;\|~`?.>,<\/\'"[\]]/', $request->lastName))
        &&(!preg_match('/[!@#$%^&*()-_=+{}:;\|~`?.>,<\/\'"[\]]/', $request->fathernName))
        &&(!preg_match('/[!@#$%^&*()-_=+{}:;\|~`?.>,<\/\'"[\]]/', $request->motherName))
        
           ){ $valid=true;}
        
        
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

        if($validatot->passes()&&$valid){
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
            if (!$valid)
            return redirect()->route("secretary.addStudent")->with('error','please dont insert special symbols');

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
        $valid=false;
        if ((!preg_match('/[0-9]/', $request->sub_name))
        &&(!preg_match('/[!@#$%^&*()-_=+{}:;\|~`?.>,<\/\'"[\]]/', $request->sub_name))
        &&(!preg_match('/[!@#$%^&*()-_=+{}:;\|~`?.>,<\/\'"[\]]/', $request->max))
        &&(!preg_match('/[!@#$%^&*()-_=+{}:;\|~`?.>,<\/\'"[\]]/', $request->min))
        &&(!preg_match('/[!@#$%^&*()-_=+{}:;\|~`?.>,<\/\'"[\]]/', $request->max_mid))
        &&(!preg_match('/[!@#$%^&*()-_=+{}:;\|~`?.>,<\/\'"[\]]/', $request->max_in_class))
        &&(!preg_match('/[!@#$%^&*()-_=+{}:;\|~`?.>,<\/\'"[\]]/', $request->max_homework))
        &&(!preg_match('/[!@#$%^&*()-_=+{}:;\|~`?.>,<\/\'"[\]]/', $request->max_final))
        
           ){ $valid=true;}

        $validatot = Validator::make($request->all(), [
            'sub_name' => 'required',
            'max' => 'required',
            'min' => 'required',
            'max_mid' => 'required',
            'max_in_class' => 'required',
            'max_homework' => 'required',
            'max_final' => 'required',
        ]);


       




        $original=Subject::all()->find($request->Subject);
       





        $qu=DB::select('select sum(max) maxe , sum(max_mid) mide , sum(max_homework) homeworke , sum(max_in_class) in_classe , sum(max_final) finale
         from subjects where belongs_to = ?',[$request->Subject]);
        foreach ($qu as $q)
        {
            $maxe=$q->maxe;
            $mide=$q->mide;
            $homeworke=$q->homeworke;
            $in_classe=$q->in_classe;
            $finale=$q->finale;
            
        }
        
        $lmaxe=$maxe+$request->max;
        $lmide=$mide+$request->max_mid;
        $lhomeworke=$homeworke+$request->max_homework;
        $lin_classe=$in_classe+$request->max_in_class;
        $lfinale=$finale+$request->max_final;
        $check=false;
        $sep=false;
        $checksep=false;
        
        // return [[$lmaxe<=$original->max]
        // ,[$lmide,$original->max_mid]
        // ,[$lhomeworke,$original->max_homework]
        // ,[$lin_classe==$original->max_in_class]
        // ,[$lfinale<=$original->max_final]];

        if  ($maxe==$original->max
        &&$mide==$original->max_mid
        &&$homeworke==$original->max_homework
        &&$in_classe==$original->max_in_class
        &&$finale==$original->max_final)
        {
            //cant seperate this subject any more
            return redirect()->route("secretary.dashbosrd")->with('error','you cant seperate this subject any more');


        }
        else
        {
            if($lmaxe<=$original->max
        &&$lmide<=$original->max_mid
        &&$lhomeworke<=$original->max_homework
        &&$lin_classe<=$original->max_in_class
        &&$lfinale<=$original->max_final)
        {

            //can proceed
            $check=true;
            //can proceed but cant seperate any more
                if($lmaxe==$original->max
            &&$lmide==$original->max_mid
            &&$lhomeworke==$original->max_homework
            &&$lin_classe==$original->max_in_class
            &&$lfinale==$original->max_final)
            {
                $checksep=true;
                
            }
            

        }
        else
        {
            //cant proceed but you can seperate this subject
            $canmax=((double)$original->max - (double)$maxe);
            $canmid=((double)$original->max_mid-(double)$mide);
             $canhomework=((double)$original->max_homework-(double)$homeworke);
             $canin_class=((double)$original->max_in_class-(double)$in_classe);
             $canfinal=((double)$original->max_final-(double)$finale);
        
        $messag="cant proceed with this input but can with the next and below .. \n max : " .$canmax
        ."\n max_mid :" .$canmid
        ."\n max_homework :" .$canhomework
        ."\n max_in_class :" .$canin_class
        ."\n max_final :" .$canfinal
        ; 
        return redirect()->route("secretary.ShowSeperatingSubject")->with('error',$messag);

           
        }
    }


        $sum=$request->max_mid+$request->max_in_class+$request->max_homework+$request->max_final;

        if($validatot->passes() && $sum==$request->max && $check&&$valid){
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


            if ($checksep)
            return redirect()->route("secretary.dashbosrd")->with('success','seperated successfully but you cant seperate this subject any more');

            
            return redirect()->route("secretary.dashbosrd")->with('success','seperated successfully');
        }else{
            if (!$valid)
            return redirect()->route("secretary.dashbosrd")->with('error','please dont insert special symbols');



            return redirect()->route("secretary.dashbosrd")->withInput()->withErrors($validatot);
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
        $tst=Subject_Teacher::all()->where('idT',$request->Teacher)->where('idS',$request->Subjects)->where('DivisionId',$request->division)->first();
        if ($tst==null)
        $st->save();
        else return 'هذا الصف مربوط ب هذا الاستاذ و  بهذه المادة بالفعل';


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


    public function ProfileSecretary(){
        return view('secretary.profile');
    }



}
