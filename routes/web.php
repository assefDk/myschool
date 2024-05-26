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
            Route::post('/fetchSubject/{div}',[TeacherDashbosrdController::class,'fetchSubject'])->name('fetchSubject');





            //Homework
            Route::get('/addHomework',[TeacherDashbosrdController::class,'addHomework'])->name('teacher.addHomework');
            Route::post('/ProcessAddHomework', [TeacherDashbosrdController::class,'ProcessAddHomework'])->name('teacher.ProcessAddHomework');







            
        });
    });
});




//Mentor
Route::group(['prefix' => 'mentor'],function(){
    Route::group(["middleware"=> "auth:sanctum"],function(){
        Route::group(['middleware' => 'mentor.auth'],function(){
            Route::get('logout', [MentorDashbosrdController::class,'logout'])->name('mentor.logout');
            Route::get('/dashbosrd',[MentorDashbosrdController::class,'index'])->name('mentor.dashbosrd');


            //fetch
            Route::post('/fetchClass/{id}',[SecretaryDashbosrdController::class,'fetchClass'])->name('fetchClass');
            Route::post('/fetchDivision/{id}',[SecretaryDashbosrdController::class,'fetchDivision'])->name('fetchDivision');
            Route::post('/fetchStudent/{id}',[MentorDashbosrdController::class,'fetchStudent'])->name('fetchStudent');
            //showAddNote
            Route::get('/showAddNote', [MentorDashbosrdController::class,'showAddNote'])->name('mentor.showAddNote');
            Route::post('/ProcessAddNote', [MentorDashbosrdController::class,'ProcessAddNote'])->name('mentor.ProcessAddNote');
        });
    });
});
