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



Route::post('/login/student', [App\Http\Controllers\Api\StudentAuthController::class,'login']);
Route::post('/login/attendant', [App\Http\Controllers\Api\AttendantAuthController::class,'login']);


Route::middleware('auth:api-student')->group(function ()
{
    Route::get('/user/student', [App\Http\Controllers\Api\StudentAuthController::class,'show'] );
    Route::post('/logout/student', [App\Http\Controllers\Api\StudentAuthController::class,'logout']);
    Route::get('/students/reservations', [App\Http\Controllers\Api\StudentController::class,'indexReservations']);
    Route::get('/students/reservations/history', [App\Http\Controllers\Api\StudentController::class,'reservationHistory']);
});

Route::middleware('auth:api-attendant')->group(function ()
{
    Route::get('/user/attendant', [App\Http\Controllers\Api\AttendantAuthController::class,'show'] );
    Route::post('/logout/attendant', [App\Http\Controllers\Api\AttendantAuthController::class,'logout']);
    Route::get('/attendants/reservations', [App\Http\Controllers\Api\AttendantController::class,'indexReservations']);
    Route::get('/attendants/reservations/history', [App\Http\Controllers\Api\AttendantController::class,'reservationHistory']);
});

Route::get('/laboratories', [App\Http\Controllers\Api\LaboratoryController::class,'laboratories']);
Route::get('/careers', [App\Http\Controllers\Api\CareerController::class,'careers']);
//Rutas para API reservacion
Route::get('/laboratories/{laboratory}/attendants', [App\Http\Controllers\Api\LaboratoryController::class,'attendants']);
Route::get('/scheduleLaboratory/hours', [App\Http\Controllers\Api\ScheduleController::class,'hours']);
Route::get('/computerLaboratory/computers', [App\Http\Controllers\Api\ComputerController::class,'computers']);
