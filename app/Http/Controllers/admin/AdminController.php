<?php

namespace App\Http\Controllers\admin;

use Carbon\Carbon;
use App\Models\Major;
use App\Models\Mentor;
use App\Models\Teacher;
use App\Models\Division;
use App\Models\TheClass;
use App\Models\Secretary;


use App\Models\Announcment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class AdminController extends Controller
{


    //Secretary
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

            return redirect()->route("admin.dashboard")->with('success','Added successfully secretary');
            
        }else{
            return redirect()->route("admin.addsecretary")->withInput()->withErrors($validatot);
        }
    }

    public function editsecretary($id){
        $secretary= Secretary::all();
            return view('admin.edit-secretary',['secretary'=>$secretary->find($id)]);
    }
    public function updatesecretary(Request $request,$id){
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
            
                $to_update=Secretary::find($id);
                $to_update->firstname=strip_tags($request->input('firstname'));
                $to_update->lastname=strip_tags($request->input('lastname'));
                $to_update->username=strip_tags($request->input('username'));
                $to_update->password=Hash::make($request->password);
                $to_update->phone=strip_tags($request->input('phone'));
                $to_update->address=strip_tags($request->input('address'));
                $to_update->email=strip_tags($request->input('email'));
                $to_update->birthdate=strip_tags($request->input('birthdate'));
                $to_update->fathername=strip_tags($request->input('fathername'));
                $to_update->mothername=strip_tags($request->input('mothername'));
                $to_update->gender=strip_tags($request->input('gender'));

            $to_update->save();
            return redirect()->route("admin.showallsecretary")->with('success',"edit successfully");
        }
        return redirect()->back()->withInput()->withErrors($validatot);
    }

    public function showallsecretary(){
        $user = db::select('select * from secretaries where isadmin != 1');
        return view('admin.show-all-secretary',compact('user'));
    }

    public function destroysecretary($id)
    {
        $to_delete=Secretary::find($id);
        $to_delete->destroy($id);
        return redirect()->route('admin.showallsecretary')->with('success', 'secretary deleted successfully.');
    }



    //Teacher
    public function addteacher(){
        $Majors = DB::select('select * from majors');
        return view('admin.add-teacher' ,compact('Majors'));
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
    public function editteacher($id){
        $teacher= Teacher::all();
            return view('admin.edit-teacher',['teacher'=>$teacher->find($id)]);
    }
    public function updateteacher(Request $request,$id){
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
                $to_update=Teacher::find($id);
                $to_update->firstname=strip_tags($request->input('firstname'));
                $to_update->lastname=strip_tags($request->input('lastname'));
                $to_update->username=strip_tags($request->input('username'));
                $to_update->password=Hash::make($request->password);
                $to_update->phone=strip_tags($request->input('phone'));
                $to_update->address=strip_tags($request->input('address'));
                $to_update->email=strip_tags($request->input('email'));
                $to_update->birthdate=strip_tags($request->input('birthdate'));
                $to_update->fathername=strip_tags($request->input('fathername'));
                $to_update->mothername=strip_tags($request->input('mothername'));
                $to_update->gender=strip_tags($request->input('gender'));
            $to_update->save();
            return redirect()->route("admin.showallteacher")->with('success',"edit successfully");
        }
        return redirect()->back()->withInput()->withErrors($validatot);
    }
    public function showallteacher(){
        $user = Teacher::all();
        return view('admin.show-all-teacher',compact('user'));
    }
    public function destroyteacher($id)
    {
        $to_delete=Teacher::find($id);
        $to_delete->destroy($id);
        return redirect()->route('admin.showallteacher')->with('success', 'teacher deleted successfully.');
    }



    //Mentor
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
    public function editmentor($id){
        $mentors= Mentor::all();
            return view('admin.edit-mentor',['mentor'=>$mentors->find($id)]);
    }
    public function updatementor(Request $request,$id){
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
                $to_update=Mentor::find($id);
                $to_update->firstname=strip_tags($request->input('firstname'));
                $to_update->lastname=strip_tags($request->input('lastname'));
                $to_update->username=strip_tags($request->input('username'));
                $to_update->password=Hash::make($request->password);
                $to_update->phone=strip_tags($request->input('phone'));
                $to_update->address=strip_tags($request->input('address'));
                $to_update->email=strip_tags($request->input('email'));
                $to_update->birthdate=strip_tags($request->input('birthdate'));
                $to_update->fathername=strip_tags($request->input('fathername'));
                $to_update->mothername=strip_tags($request->input('mothername'));
                $to_update->gender=strip_tags($request->input('gender'));
            $to_update->save();
            return redirect()->route("admin.showallmentor")->with('success',"edit successfully");
        }
        return redirect()->back()->withInput()->withErrors($validatot);
    }
    public function showallmentor(){
        $user = Mentor::all();
        return view('admin.show-all-mentor',compact('user'));
    }
    public function destroymentor($id)
    {
        $to_delete=Mentor::find($id);
        $to_delete->destroy($id);
        return redirect()->route('admin.showallmentor')->with('success', 'mentor deleted successfully.');    
    }











    //add class
    public function addclass(){
        return view("admin.add-class");
    }    

    public function processClass(Request $request){
        $tm = 0;
        $theMajor = [];
        
        if (($request->get('ClassName') == "ClassTen" || $request->get('ClassName') == "ClassTwelfth" || $request->get('ClassName') == "ClassThirteenth") && $request->majorname == "General") {
            return redirect()->route("admin.dashboard")->with('error', 'The input error');
        }

        foreach (Major::all() as $m){
            if($request->majorname == $m->name){
                $tm = 1;
                $theMajor = $m;
            }
        }
        
        if($tm == 0){
            DB::table('majors')
            ->insert([
                'name'=> $request->majorname,
                'created_at'=> Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
             //اخز اخر قيمة تم ادخالها
            $theMajor = DB::table('majors')->latest()->first();
        }
        // /__________________________________/

        $tc = 0;
        $theclass = [];
        foreach (TheClass::all() as $c){

            if (DB::select('select * from  the_classes c,divisions d, majors m where

                    m.name = :majorname and 
                    c.ClassName = :ClassName and 
                    d.Numberdvs = :division and
                    c.MajorId = m.MajorId and
                    c.ClassId = d.ClassId 
                    '
                    , [
                        'majorname' => $request->get('majorname'),
                        'ClassName' => $request->get('ClassName'),
                        'division' => $request->get('division'),
                    ]))
            {
                return redirect()->route("admin.dashboard")->with('error','The class exists 1');
            }
            if($request->get('ClassName') == $c->ClassName){
                $tc = 1;
                $theclass = $c;
            }
            
            if($request->get('ClassName') == "ClassTen" ||$request->get('ClassName') == "ClassTwelfth"||$request->get('ClassName') == "ClassThirteenth"){
                if(Db::select('select * from the_classes where
                ClassName = :ClassName and MajorId = :MajorId ' 
                , ['ClassName' => $request->get('ClassName'), 'MajorId' => $theMajor->MajorId,]))
                {
                    $test = TheClass::where(['ClassName' => $request->get('ClassName'),'MajorId' => $theMajor->MajorId])->first();
                    $theclass = $test;
                    $tc = 1;
                    break;
                }
                $tc = 0;
                break;
            }
        }

        if($tc == 0){
            DB::table('the_classes')->insert([
                'ClassName' => $request->get('ClassName'),
                'MajorId' => $theMajor->MajorId,
                'created_at'=> Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
            //اخز اخر قيمة تم ادخالها
            $theclass = DB::table('the_classes')->latest()->first();
        }
        // /____________________________________
        
        $td = 0;
        foreach (Division::all() as $d){
            if($request->get('ClassName') == "ClassTen" || $request->get('ClassName') == "ClassTwelfth"||$request->get('ClassName') == "ClassThirteenth"){
                $td = 0;
                break;
            }
            elseif($request->get('division') == $d->Numberdvs && $d->ClassId == $theclass->ClassId){
                $td = 1;
                return redirect()->route("admin.dashboard")->with('error','The class exists 2');
            }   
        }
        if($td == 0){
            DB::table('divisions')->insert([
                'Numberdvs' => $request->get('division'),
                'ClassId' => $theclass->ClassId,
                'WeeklySchedule' => 'noWeeklyScheduleNow',
                'created_at'=> Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }

        return redirect()->route("admin.dashboard")->with('success','Added successfully class');
    }

    public function deleteClass($DivisionId,$ClassId)
    {
        DB::table('divisions')->where('DivisionId', $DivisionId)->delete();

        $remainingDivisions = DB::table('divisions')->where('ClassId', $ClassId)->count();
        if ($remainingDivisions === 0) {
            DB::table('the_classes')->where('ClassId', $ClassId)->delete();
        }
        return redirect()->route('admin.showallclass')->with('success', 'Class deleted successfully.');
    }

    public function showallclass(){
        $classes = DB::select('select * from  the_classes c,divisions d, majors m where c.MajorId = m.MajorId and c.ClassId = d.ClassId ');
        return view('admin.show-all-class',compact('classes'));
    }


    
    
    //add announcment
    public function addAnnouncment(){
        return view('admin.add-announcment');
    }


    public function processAnnouncment(Request $request){

        $test = false;

        if($request->has('all') )
        {
            $test = true;
            $anew =  new Announcment();

            $anew->creator = 'manager ' . auth()->user()->firstname .' '. auth()->user()->lastname;
            $anew->title = $request->title;
            $anew->content = $request->content;
            $anew->Date_Created = Carbon::now();
            $anew->Expiry_date = $request->date;
            $anew->status  = 'sstm';
    
            $anew->save();

            return redirect()->route('admin.addAnnouncment')->with('success', 'added  Successfully Announcment');
        }

        if($request->has('students'))
        {
            $test = true;
            $anew =  new Announcment();

            $anew->creator = 'manager ' . auth()->user()->firstname .' '. auth()->user()->lastname;
            $anew->title = $request->title;
            $anew->content = $request->content;
            $anew->Date_Created = Carbon::now();
            $anew->Expiry_date = $request->date;
            $anew->status  = 'sud';
    

            $anew->save();

        }

        if($request->has('secretary'))
        {
            $test = true;
            $anew =  new Announcment();

            $anew->creator = 'manager ' . auth()->user()->firstname .' '. auth()->user()->lastname;
            $anew->title = $request->title;
            $anew->content = $request->content;
            $anew->Date_Created = Carbon::now();
            $anew->Expiry_date = $request->date;
            $anew->status  = 'se';
    

            $anew->save();

        }
        if($request->has('mentors'))
        {
            $test = true;
            $anew =  new Announcment();

            $anew->creator = 'manager ' . auth()->user()->firstname .' '. auth()->user()->lastname;
            $anew->title = $request->title;
            $anew->content = $request->content;
            $anew->Date_Created = Carbon::now();
            $anew->Expiry_date = $request->date;
            $anew->status  = 'm';
    

            $anew->save();

        }
        if($request->has('teachers'))
        {
            $test = true;
            $anew =  new Announcment();

            $anew->creator = 'manager ' . auth()->user()->firstname .' '. auth()->user()->lastname;
            $anew->title = $request->title;
            $anew->content = $request->content;
            $anew->Date_Created = Carbon::now();
            $anew->Expiry_date = $request->date;
            $anew->status  = 't';
    

            $anew->save();
        }
        
        if($test){
            return redirect()->route('admin.addAnnouncment')->with('success', 'added  Successfully Announcment');
        }else{
            return redirect()->route('admin.addAnnouncment')->with('error', 'Please enter correct information');
        }
        
    }



    //search
    public function search(){
        $Secretarys = Secretary::all();
        $Mentors = Mentor::all();
        $Teachers = Teacher::all();


        return view('admin.searchEmp',compact('Secretarys','Mentors','Teachers'));
    }

    public function processsearch(Request $request){
        
    }
















}


