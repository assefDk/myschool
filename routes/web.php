<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\DashbosrdController as AdminDashbosrdController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\secretary\DashbosrdController as SecretaryDashbosrdController;
use App\Http\Controllers\teacher\DashbosrdController as TeacherDashbosrdController;
use App\Http\Controllers\mentor\DashbosrdController as MentorDashbosrdController;



// Route::get('/', function () {
//     return view('welcome');
// });










//All
Route::get('/', [LoginController::class,'index'])->name('login');
Route::post('authenticate', [LoginController::class,'authenticate'])->name('authenticate');





//Admin
Route::group(['prefix' => 'admin'],function(){
    Route::group(["middleware"=> "auth:sanctum"],function(){
        Route::group(['middleware' => 'admin.auth'],function(){
            Route::get('dashbosrd',[AdminDashbosrdController::class,'index'])->name('admin.dashboard');
            

            //Add Secretary
            Route::get('/addsecretary', [AdminController::class,'addsecretary'])->name('admin.addsecretary');
            Route::post('/processaddsecretary', [AdminController::class,'processaddsecretary'])->name('admin.processaddsecretary');
            //Edit secretary
            Route::get('/editsecretary/{id}', [AdminController::class,'editsecretary'])->name('admin.editsecretary');
            Route::post('updatesecretary/{id}',[AdminController::class,'updatesecretary'])->name('admin.updatesecretary');
            //Destroy secretary
            Route::delete('admin.destroysecretary/{id}',[AdminController::class,'destroysecretary'])->name('admin.destroysecretary');
            //Show All secretary
            Route::get('/showallsecretary', [AdminController::class,'showallsecretary'])->name('admin.showallsecretary');


            //Add Teacher
            Route::get('/addteacher', [AdminController::class,'addteacher'])->name('admin.addteacher');
            Route::post('/processaddteacher', [AdminController::class,'processaddteacher'])->name('admin.processaddteacher');
            //edit teacher
            Route::get('/editteacher/{id}', [AdminController::class,'editteacher'])->name('admin.editteacher');
            Route::post('updateteacher/{id}',[AdminController::class,'updateteacher'])->name('admin.updateteacher');
            //delete teacher
            Route::delete('admin.destroyteacher/{id}',[AdminController::class,'destroyteacher'])->name('admin.destroyteacher');
            //Show All teacher
            Route::get('/showallteacher', [AdminController::class,'showallteacher'])->name('admin.showallteacher');




            //Add Mentor
            Route::get('/addmentor', [AdminController::class,'addmentor'])->name('admin.addmentor');
            Route::post('/processaddmentor', [AdminController::class,'processaddmentor'])->name('admin.processaddmentor');
            //edit Mentor
            Route::get('/editmentor/{id}', [AdminController::class,'editmentor'])->name('admin.editmentor');
            Route::post('updatementor/{id}',[AdminController::class,'updatementor'])->name('admin.updatementor');
            //delete Mentor
            Route::delete('admin.destroymentor/{id}',[AdminController::class,'destroymentor'])->name('admin.destroymentor');
            //Show All Mentor
            Route::get('/showallmentor', [AdminController::class,'showallmentor'])->name('admin.showallmentor');




            //Add Class
            Route::get('addclass',[AdminController::class,'addclass'])->name('admin.add-class');
            Route::get('showallclass',[AdminController::class,'showallclass'])->name('admin.showallclass');
            Route::post('processClass',[AdminController::class,'processClass'])->name('admin.processClass');
            Route::get('/deleteClass/{DivisionId}/{ClassId}', [AdminController::class,'deleteClass'])->name('admin.deleteClass');
            
            //Add Announcment
            Route::get('addAnnouncment',[AdminController::class,'addAnnouncment'])->name('admin.addAnnouncment');
            Route::post('processAnnouncment',[AdminController::class,'processAnnouncment'])->name('admin.processAnnouncment');
    
            
            // searchEmp
            Route::get('Allemp',[AdminController::class,'search'])->name('admin.searchEmp');
            Route::post('searchEmp',[AdminController::class,'processsearch'])->name('admin.processsearch');
            
            
            // Profile
            Route::get('Profile',[AdminController::class,'Profile'])->name('admin.Profile');
            
            
            //test
            Route::get('nav',[AdminController::class,'la'])->name('admin.nav');
            
            
            
            
            
            
            
            
            
            Route::get('employers_managment',[AdminController::class,'employers_managment'])->name('admin.employers_managment');

            
            // add emp
            Route::get('add_emp',[AdminController::class,'add_emp'])->name('admin.add_emp');
            Route::post('/processaddEmp', [AdminController::class,'processaddEmp'])->name('admin.processaddEmp');






            Route::get('logout', [AdminDashbosrdController::class,'logout'])->name('admin.logout');
        });
    });
});




//Secretary
Route::group(['prefix' => 'secretary'],function(){
    Route::group(["middleware"=> "auth:sanctum"],function(){
        Route::group(['middleware' => 'secretary.auth'],function(){
            Route::get('/dashbosrd',[SecretaryDashbosrdController::class,'index'])->name('secretary.dashbosrd');
            Route::get('/logout', [SecretaryDashbosrdController::class,'logout'])->name('secretary.logout');
            //Add Student
            Route::get('/addStudent',[SecretaryDashbosrdController::class,'addStudent'])->name('secretary.addStudent');
            Route::post('/processAddStudent',[SecretaryDashbosrdController::class,'processAddStudent'])->name('processAddStudent');
            Route::post('/fetchClass/{id}',[SecretaryDashbosrdController::class,'fetchClass'])->name('fetchClass');
            Route::post('/fetchDivision/{id}',[SecretaryDashbosrdController::class,'fetchDivision'])->name('fetchDivision');
            Route::post('/fetchSubject/{div}',[SecretaryDashbosrdController::class,'fetchSubject'])->name('fetchSubject');

            
            
            //Add Subject
            Route::get('/addSubject',[SecretaryDashbosrdController::class,'addSubject'])->name('secretary.addSubject');
            Route::post('/processAddSubject',[SecretaryDashbosrdController::class,'processAddSubject'])->name('secretary.processAddSubject');
            Route::get('/SelectClass',[SecretaryDashbosrdController::class,'SelectClass'])->name('secretary.SelectClass');
            Route::post('/ShowAllSubject',[SecretaryDashbosrdController::class,'ShowAllSubject'])->name('secretary.ShowAllSubject');


            //Connecting teacher with Subject
            Route::get('/ShowConnectingTeacherWithSubject',[SecretaryDashbosrdController::class,'ShowConnectingTeacherWithSubject'])->name('secretary.ShowConnectingTeacherWithSubject');
            Route::post('/ConnectingTeacherWithSubject',[SecretaryDashbosrdController::class,'ConnectingTeacherWithSubject'])->name('secretary.ConnectingTeacherWithSubject');



            //Announcment
            Route::get('/showAnnouncment',[SecretaryDashbosrdController::class,'showAnnouncment'])->name('secretary.showAnnouncment');


            //new 
            //Edit subject
            Route::get('/editsubject/{id}', [SecretaryDashbosrdController::class,'editsubject'])->name('secretary.editsubject');
            Route::post('updatesubject/{id}',[SecretaryDashbosrdController::class,'updatesubject'])->name('secretary.updatesubject');


            //Destroy subject
            Route::delete('admin.destroysubject/{id}',[SecretaryDashbosrdController::class,'destroysubject'])->name('secretary.destroysubject');


            //seperating subjects
            Route::get('/ShowSeperatingSubject', [SecretaryDashbosrdController::class,'ShowSeperatingSubject'])->name('secretary.ShowSeperatingSubject');
            Route::post('/SeperatingSubject',[SecretaryDashbosrdController::class,'SeperatingSubject'])->name('secretary.SeperatingSubject');

            //end new 




             // Profile
             Route::get('Profile',[SecretaryDashbosrdController::class,'ProfileSecretary'])->name('secretary.Profile');





        });
    });
});


//Teacher
Route::group(['prefix' => 'teacher'],function(){
    Route::group(["middleware"=> "auth:sanctum"],function(){
        Route::group(['middleware' => 'teacher.auth'],function(){
            Route::get('logout', [TeacherDashbosrdController::class,'logout'])->name('teacher.logout');
            Route::get('/dashbosrd',[TeacherDashbosrdController::class,'index'])->name('teacher.dashbosrd');


            //fetchs
            Route::post('/fetchClass/{id}',[TeacherDashbosrdController::class,'fetchClass'])->name('fetchClass');
            Route::post('/fetchDivision/{id}',[TeacherDashbosrdController::class,'fetchDivision'])->name('fetchDivision');
            Route::post('/fetchSubject/{id}',[TeacherDashbosrdController::class,'fetchSubject'])->name('fetchSubject');
            Route::post('/fetchStudent/{id}',[TeacherDashbosrdController::class,'fetchStudent'])->name('fetchStudent');




            //Homework
            Route::get('/addHomework',[TeacherDashbosrdController::class,'addHomework'])->name('teacher.addHomework');
            Route::post('/ProcessAddHomework', [TeacherDashbosrdController::class,'ProcessAddHomework'])->name('teacher.ProcessAddHomework');



            //Announcment
            Route::get('/addAnnouncment',[TeacherDashbosrdController::class,'addAnnouncment'])->name('teacher.addAnnouncment');
            Route::post('/ProcessAddAnnouncment', [TeacherDashbosrdController::class,'processAddAnnouncment'])->name('teacher.ProcessAddAnnouncment');
            Route::get('/showAnnouncment',[TeacherDashbosrdController::class,'showAnnouncment'])->name('teacher.showAnnouncment');




            //Node
            Route::get('/addNode',[TeacherDashbosrdController::class,'addNode'])->name('teacher.addNode');
            Route::post('/ProcessAddNodet', [TeacherDashbosrdController::class,'ProcessAddNodet'])->name('teacher.ProcessAddNode');




            // Route::post('/fetchClass/{id}',[SecretaryDashbosrdController::class,'fetchClass'])->name('fetchClass');
            Route::post('/fetchDivision/{id}',[SecretaryDashbosrdController::class,'fetchDivision'])->name('fetchDivision');
            Route::post('/fetchStudent/{id}',[MentorDashbosrdController::class,'fetchStudent'])->name('fetchStudent');


            Route::get('/showaddMark', [TeacherDashbosrdController::class,'showaddMark'])->name('teacher.showaddMark');
            Route::post('/addMark', [TeacherDashbosrdController::class,'addMark'])->name('teacher.addMark');
            Route::post('/ProcessAddMark/{id}', [TeacherDashbosrdController::class,'ProcessAddMark'])->name('teacher.ProcessAddMark');
            Route::post('/fetchsubtea/{id}',[TeacherDashbosrdController::class,'fetchsubtea'])->name('fetchsubtea');





            //Profile
            Route::get('Profilee',[TeacherDashbosrdController::class,'ProfileTeacher'])->name('teacher.Profile');




        });
    });
});




//Mentor
Route::group(['prefix' => 'mentor'],function(){
    Route::group(["middleware"=> "auth:sanctum"],function(){
        Route::group(['middleware' => 'mentor.auth'],function(){
            Route::get('logout', [MentorDashbosrdController::class,'logout'])->name('mentor.logout');
            Route::get('/dashbosrd',[MentorDashbosrdController::class,'index'])->name('mentor.dashbosrd');


            // Route::get('/dashbosrdfake/{id}',[MentorDashbosrdController::class,'dashbosrdfake'])->name('mentor.dashbosrdfake');


            //fetch
            Route::post('/fetchClass/{id}',[SecretaryDashbosrdController::class,'fetchClass'])->name('fetchClass');
            Route::post('/fetchDivision/{id}',[SecretaryDashbosrdController::class,'fetchDivision'])->name('fetchDivision');
            Route::post('/fetchStudent/{id}',[MentorDashbosrdController::class,'fetchStudent'])->name('fetchStudent');

            //showAddNote
            Route::get('/showAddNote', [MentorDashbosrdController::class,'showAddNote'])->name('mentor.showAddNote');
            Route::post('/ProcessAddNote', [MentorDashbosrdController::class,'ProcessAddNote'])->name('mentor.ProcessAddNote');

            //addWeeklySchedule
            Route::get('/addWeeklySchedule', [MentorDashbosrdController::class,'addWeeklySchedule'])->name('mentor.addWeeklySchedule');
            Route::post('/ProcessAddWeeklySchedule', [MentorDashbosrdController::class,'ProcessAddWeeklySchedule'])->name('mentor.ProcessAddWeeklySchedule');

            
            //Announcment
            Route::get('/addAnnouncment',[MentorDashbosrdController::class,'addAnnouncment'])->name('mentor.addAnnouncment');
            Route::post('/processAddAnnouncment', [MentorDashbosrdController::class,'processAddAnnouncment'])->name('mentor.ProcessAddAnnouncment');
            Route::get('/showAnnouncment',[MentorDashbosrdController::class,'showAnnouncment'])->name('mentor.showAnnouncment');
           
            






            // new
            Route::get('/showMarks', [MentorDashbosrdController::class,'showMarks'])->name('mentor.showMarks');
            Route::post('/fetchMClass/{id}',[MentorDashbosrdController::class,'fetchMClass'])->name('mentor.fetchMClass');
            Route::post('/showStudents', [MentorDashbosrdController::class,'showStudents'])->name('mentor.showStudents');
            Route::get('/studentDetails/{id}', [MentorDashbosrdController::class,'studentDetails'])->name('mentor.studentDetails');
            //test
            Route::get('/test/{id}', [MentorDashbosrdController::class,'isSeperated'])->name('mentor.test');

            Route::get('/markDetails/{id}', [MentorDashbosrdController::class,'markDetails'])->name('mentor.markDetails');
            // end new



            //Profile
            Route::get('Profile',[MentorDashbosrdController::class,'ProfileMentor'])->name('mentor.Profile');






        });
    });
});
