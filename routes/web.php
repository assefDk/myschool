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
// Route::group(['middleware' => 'admin.guest'],function(){    
    Route::get('/', [LoginController::class,'index'])->name('login');
    Route::post('authenticate', [LoginController::class,'authenticate'])->name('authenticate');
// });








//Admin
// Route::group(['prefix' => 'admin'],function(){
//     Route::group(['middleware' => 'admin.auth'],function(){
        Route::get('dashbosrd',[AdminDashbosrdController::class,'index'])->name('admin.dashboard');
        

        
        //Add Secretary
        Route::get('/showallsecretary', [AdminController::class,'showallsecretary'])->name('admin.showallsecretary');
        Route::get('/addsecretary', [AdminController::class,'addsecretary'])->name('admin.addsecretary');
        Route::post('/processaddsecretary', [AdminController::class,'processaddsecretary'])->name('admin.processaddsecretary');
        Route::post('/deleteSecretary/{id}', [AdminController::class,'deleteSecretary'])->name('admin.deleteSecretary');

        
        
        //Add Teacher
        Route::get('/showallteacher', [AdminController::class,'showallteacher'])->name('admin.showallteacher');
        Route::get('/addteacher', [AdminController::class,'addteacher'])->name('admin.addteacher');
        Route::post('/processaddteacher', [AdminController::class,'processaddteacher'])->name('admin.processaddteacher');
        

        //Add Mentor
        Route::get('/showallmentor', [AdminController::class,'showallmentor'])->name('admin.showallmentor');
        Route::get('/addmentor', [AdminController::class,'addmentor'])->name('admin.addmentor');
        Route::post('/processaddmentor', [AdminController::class,'processaddmentor'])->name('admin.processaddmentor');
        
        //Add Class
        Route::get('addclass',[AdminController::class,'addclass'])->name('admin.add-class');
        Route::get('showallclass',[AdminController::class,'showallclass'])->name('admin.showallclass');
        Route::post('processClass',[AdminController::class,'processClass'])->name('admin.processClass');
        Route::get('/deleteClass/{DivisionId}/{ClassId}', [AdminController::class,'deleteClass'])->name('admin.deleteClass');
        
        //Add Announcment
        Route::get('addAnnouncment',[AdminController::class,'addAnnouncment'])->name('admin.addAnnouncment');
        Route::post('processAnnouncment',[AdminController::class,'processAnnouncment'])->name('admin.processAnnouncment');
        


        Route::get('logout', [AdminDashbosrdController::class,'logout'])->name('admin.logout');
//     });
    
// });




//Secretary
Route::group(['prefix' => 'secretary'],function(){
    Route::group(['middleware' => 'secretary.auth'],function(){
        Route::get('/dashbosrd',[SecretaryDashbosrdController::class,'index'])->name('secretary.dashbosrd');
        Route::get('/logout', [SecretaryDashbosrdController::class,'logout'])->name('secretary.logout');
        //Add Student
        Route::get('/addStudent',[SecretaryDashbosrdController::class,'addStudent'])->name('secretary.addStudent');
        Route::post('/processAddStudent',[SecretaryDashbosrdController::class,'processAddStudent'])->name('processAddStudent');
        Route::post('/fetchClass/{id}',[SecretaryDashbosrdController::class,'fetchClass'])->name('fetchClass');
        Route::post('/fetchDivision/{id}',[SecretaryDashbosrdController::class,'fetchDivision'])->name('fetchDivision');
        
        //Add Subject
        Route::get('/addSubject',[SecretaryDashbosrdController::class,'addSubject'])->name('secretary.addSubject');
        Route::post('/processAddSubject',[SecretaryDashbosrdController::class,'processAddSubject'])->name('secretary.processAddSubject');
        Route::get('/showAllSubject',[SecretaryDashbosrdController::class,'showAllSubject'])->name('secretary.showAllSubject');
        Route::get('/SubjectInClass',[SecretaryDashbosrdController::class,'SubjectInClass'])->name('secretary.SubjectInClass');

        

        

    });
});


//Teacher
Route::group(['prefix' => 'teacher'],function(){
    Route::group(['middleware' => 'teacher.auth'],function(){
        Route::get('/dashbosrd',[TeacherDashbosrdController::class,'index'])->name('teacher.dashbosrd');
    });
});

//Mentor
Route::group(['prefix' => 'mentor'],function(){
    Route::group(['middleware' => 'mentor.auth'],function(){
        Route::get('/dashbosrd',[MentorDashbosrdController::class,'index'])->name('mentor.dashbosrd');
        Route::get('logout', [MentorDashbosrdController::class,'logout'])->name('mentor.logout');

    });
});






