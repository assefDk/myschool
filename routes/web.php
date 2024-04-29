<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\DashbosrdController as AdminDashbosrdController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\secretary\DashbosrdController as SecretaryDashbosrdController;
use App\Http\Controllers\teacher\DashbosrdController as TeacherDashbosrdController;
use App\Http\Controllers\mentor\DashbosrdController as MentorDashbosrdController;



Route::get('/', function () {
    return view('welcome');
});






// Route::get('login', [LoginController::class,'index'])->name('login');
// Route::post('authenticate', [LoginController::class,'authenticate'])->name('authenticate');





//All
Route::group(['middleware' => 'admin.guest'],function(){    
    Route::get('login', [LoginController::class,'index'])->name('login');
    Route::post('authenticate', [LoginController::class,'authenticate'])->name('authenticate');

});






//Admin
Route::group(['prefix' => 'admin'],function(){
    Route::group(['middleware' => 'admin.auth'],function(){
        Route::get('dashbosrd',[AdminDashbosrdController::class,'index'])->name('admin.dashboard');
        //Add Secretary
        Route::get('/showallsecretary', [AdminController::class,'showallsecretary'])->name('admin.showallsecretary');
        Route::get('/addsecretary', [AdminController::class,'addsecretary'])->name('admin.addsecretary');
        Route::post('/processaddsecretary', [AdminController::class,'processaddsecretary'])->name('admin.processaddsecretary');

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



        Route::get('logout', [AdminDashbosrdController::class,'logout'])->name('admin.logout');
    });
    
});




//Secretary
Route::group(['prefix' => 'secretary'],function(){
    Route::group(['middleware' => 'secretary.auth'],function(){
        Route::get('/dashbosrd',[SecretaryDashbosrdController::class,'index'])->name('secretary.dashbosrd');
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








//ex
// Route::group(['prefix' => 'admin'],function(){
//     //all customer
//     Route::group(['middleware' => 'admin.guest'],function(){
//         Route::get('login', [AdminLoginController::class,'index'])->name('admin.login');
//         Route::post('authenticate', [AdminLoginController::class,'authenticate2'])->name('admin.authenticate');

//     });
    
    
    
//     //auth
//     Route::group(['middleware' => 'admin.auth'],function(){
//         Route::get('dashboard', [AdminDashboardController::class,'index'])->name('admin.dashboard');
//         Route::get('logout', [AdminLoginController::class,'logout'])->name('admin.logout');

//     });

// });