<?php

use Illuminate\Http\Request;
use Modules\Room\Http\Controllers\RoomController;
use Modules\Treatment\Http\Controllers\ProgramTypeController;
use Modules\Treatment\Http\Controllers\SessionTypeController;
use Modules\Treatment\Http\Controllers\ProgramSystemController;
use Modules\Treatment\Http\Controllers\TreatmentController;
use Modules\Treatment\Http\Controllers\TreatmentTypeController;
use Modules\Treatment\Http\Controllers\AssessmentTypeController;
use Modules\Treatment\Http\Controllers\AppointmentTypeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware('auth:api')->get('/treatment', function (Request $request) {
    return $request->user();
});

Route::apiResource('assessment-types',AssessmentTypeController::class);
Route::apiResource('programtypes',ProgramTypeController::class);
Route::apiResource('appointmenttypes',AppointmentTypeController::class);
Route::apiResource('program-system',ProgramSystemController::class);
Route::apiResource('session-types',SessionTypeController::class);
Route::apiResource('treatment-types',TreatmentTypeController::class);
Route::apiResource('treatments',TreatmentController::class);
Route::get('getrome_data',[RoomController::class,'index']);
Route::post('store_room',[RoomController::class,'store']);
Route::delete('destroy/room/{id}',[RoomController::class,'destroy']);
Route::post('update/room/{id}',[RoomController::class,'update']);
Route::get('get/room/{id}',[RoomController::class,'show']);
Route::get('all/doctors',[RoomController::class,'getDortor']);
Route::get('all/doctors',[RoomController::class,'getDortor']);
Route::get('allInputData',[RoomController::class,'allInputData']);

