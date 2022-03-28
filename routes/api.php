<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/laboratories', [App\Http\Controllers\Api\LaboratoryController::class,'laboratories']);
Route::get('/careers', [App\Http\Controllers\Api\CareerController::class,'careers']);
Route::get('/scheduleLaboratory/hours', [App\Http\Controllers\Api\ScheduleController::class,'hours']);
Route::get('/computerLaboratory/computers', [App\Http\Controllers\Api\ComputerController::class,'computers']);
Route::get('/students/reservations', [App\Http\Controllers\Api\StudentController::class,'getReservationsReserved']);
Route::get('/attendants/reservations', [App\Http\Controllers\Api\AttendantController::class,'getReservationsReserved']);