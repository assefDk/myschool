<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiLoginStudentController;

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
});