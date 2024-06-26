<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiLoginStudentController;
use App\Http\Controllers\mentor\DashbosrdController as MentorDashbosrdController;
use App\Http\Controllers\secretary\DashbosrdController as SecretaryDashbosrdController;




// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');



//loginStudent
Route::post('loginStudent',[ApiLoginStudentController::class,"loginStudent"])->name('loginStudent');


Route::group([
    "middleware"=> ["auth:sanctum"]
],function(){
    //profileStudent
    Route::get('profileStudent',[ApiLoginStudentController::class,"profileStudent"])->name('profileStudent');
    //logoutStudent
    Route::get('logoutStudent',[ApiLoginStudentController::class,"logoutStudent"])->name('logoutStudent');
    //nodeStudent
    Route::get('nodeStudent',[ApiLoginStudentController::class,"nodeStudent"])->name('nodeStudent');
    //AnnouncmentStudent
    Route::get('AnnouncmentStudent',[ApiLoginStudentController::class,"AnnouncmentStudent"])->name('AnnouncmentStudent');
    //HomeworkSudent
    Route::get('HomeworkSudent',[ApiLoginStudentController::class,"HomeworkSudent"])->name('HomeworkSudent');
    //WeeklyScheduleSudent
    Route::get('WeeklyScheduleSudent',[ApiLoginStudentController::class,"WeeklyScheduleSudent"])->name('WeeklyScheduleSudent');
    //showsubjectStudent
    Route::get('showsubjectStudent',[ApiLoginStudentController::class,"showsubjectStudent"])->name('showsubjectStudent');
    //showMarkStudent
    Route::get('showMarkStudent',[ApiLoginStudentController::class,"showMarkStudent"])->name('showMarkStudent');



});
