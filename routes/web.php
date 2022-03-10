<?php

use Illuminate\Support\Facades\Route;
use Whoops\Run;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('role'); 
    //return view('welcome');
});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//name es para darle un alias a la ruta

Route::prefix('user')->name('user.')->group(function(){

    Route::middleware(['guest:web','PreventBackHistory'])->group(function(){
        Route::view('/login', 'dashboard.user.login')->name('login');
        Route::view('/register', 'dashboard.user.register')->name('register');
        Route::post('/create', [App\Http\Controllers\UserController::class, 'create'])->name('create');
        Route::post('/check', [App\Http\Controllers\UserController::class, 'check'])->name('check');

    });

    Route::middleware(['auth:web','PreventBackHistory'])->group(function(){
        Route::view('/home', 'dashboard.user.home')->name('home');
        Route::post('/logout', [App\Http\Controllers\UserController::class, 'logout'])->name('logout');
    });
});

Route::prefix('student')->name('student.')->group(function(){

    Route::middleware(['guest:student', 'PreventBackHistory'])->group(function(){
        Route::view('/login', 'dashboard.student.login')->name('login');
        Route::get('/register', [App\Http\Controllers\StudentController::class, 'register'])->name('register');
        Route::post('/create', [App\Http\Controllers\StudentController::class, 'create'])->name('create');
        Route::post('/check', [App\Http\Controllers\StudentController::class, 'check'])->name('check');

    });

    Route::middleware(['auth:student', 'PreventBackHistory'])->group(function(){
        Route::view('/home', 'dashboard.student.home')->name('home');
        Route::post('/logout', [App\Http\Controllers\StudentController::class, 'logout'])->name('logout');
    });
});

Route::prefix('attendant')->name('attendant.')->group(function (){
    
    Route::middleware(['guest:attendant','PreventBackHistory' ])->group(function(){
        Route::view('/login', 'dashboard.attendant.login')->name('login');
        Route::post('/check', [App\Http\Controllers\AttendantController::class, 'check'])->name('check');
    });

    Route::middleware(['auth:attendant', 'PreventBackHistory'])->group(function(){
        Route::view('/home', 'dashboard.attendant.home')->name('home');
        Route::post('/logout', [\App\Http\Controllers\AttendantController::class, 'logout'])->name('logout');
    });
});

//Career
Route::get('/careers', [App\Http\Controllers\CareerController::class, 'index']);//devuelve un vista con el listado de carreras
Route::get('/careers/create', [App\Http\Controllers\CareerController::class, 'create']);//devuelve un vista con el form de registro
Route::get('/careers/{career}/edit', [App\Http\Controllers\CareerController::class, 'edit']);//devuelve una vista con el form de edición
Route::post('/careers', [App\Http\Controllers\CareerController::class, 'store']);//envío del form
Route::put('/careers/{career}', [App\Http\Controllers\CareerController::class, 'update']);//envio del form para actualizar
Route::delete('/careers/{career}/delete', [App\Http\Controllers\CareerController::class, 'destroy']);//ruta para eliminar una carrera

//Laboratory
Route::get('/laboratories', [App\Http\Controllers\LaboratoryController::class, 'index']);
Route::get('/laboratories/create', [App\Http\Controllers\LaboratoryController::class, 'create']);
Route::get('/laboratories/{laboratory}/edit', [App\Http\Controllers\LaboratoryController::class, 'edit']);
Route::post('/laboratories', [App\Http\Controllers\LaboratoryController::class, 'store']);
Route::put('/laboratories/{laboratory}', [App\Http\Controllers\LaboratoryController::class, 'update']);
Route::delete('/laboratories/{laboratory}/delete', [App\Http\Controllers\LaboratoryController::class, 'destroy']);

//Attendant
Route::get('/attendants', [App\Http\Controllers\AttendantController::class, 'index']);
Route::get('/attendants/create', [App\Http\Controllers\AttendantController::class, 'create']);
Route::get('/attendants/{attendant}/edit', [App\Http\Controllers\AttendantController::class, 'edit']);
Route::post('/attendants', [App\Http\Controllers\AttendantController::class, 'store']);
Route::put('/attendants/{attendant}', [App\Http\Controllers\AttendantController::class, 'update']);
Route::delete('/attendants/{attendant}/delete', [App\Http\Controllers\AttendantController::class, 'destroy']);

//Student
Route::get('/students', [\App\Http\Controllers\StudentController::class, 'index']);

//ScheduleLaboratory
Route::get('/schedule', [\App\Http\Controllers\ScheduleLaboratoryController::class, 'index']);
Route::get('/schedule/create', [App\Http\Controllers\ScheduleLaboratoryController::class, 'create']);
Route::post('/schedule', [App\Http\Controllers\ScheduleLaboratoryController::class, 'store']);
Route::get('/schedule/{schedule}/edit',[App\Http\Controllers\ScheduleLaboratoryController::class, 'edit']);
Route::put('/schedule/{schedule}',[App\Http\Controllers\ScheduleLaboratoryController::class, 'update']);
Route::delete('/schedule/{schedule}/delete',[App\Http\Controllers\ScheduleLaboratoryController::class, 'destroy']);