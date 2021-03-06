<?php

use App\Http\Controllers\ComputerController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    
    //FCM
    Route::post('fcm/send', [App\Http\Controllers\FirebaseController::class, 'sendAll'])->name('fcm');
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
Route::get('/careers/{career}/edit', [App\Http\Controllers\CareerController::class, 'edit']);//devuelve una vista con el form de edici??n
Route::post('/careers', [App\Http\Controllers\CareerController::class, 'store']);//env??o del form
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
Route::get('/schedule/{laboratory}', [\App\Http\Controllers\ScheduleLaboratoryController::class, 'edit']);
Route::post('/schedule/{laboratory}/store', [App\Http\Controllers\ScheduleLaboratoryController::class, 'store']);

//Computers
Route::get('/laboratory/computers/{laboratory}', [\App\Http\Controllers\ComputerController::class, 'index']);
Route::get('/laboratory/computers/{laboratory}/create', [\App\Http\Controllers\ComputerController::class, 'create']);
Route::post('/laboratory/computers/{laboratory}/store', [App\Http\Controllers\ComputerController::class, 'store']);
Route::delete('/laboratory/computers/{computers}/delete', [App\Http\Controllers\ComputerController::class, 'destroy']);

Route::get('/appointments/create', [\App\Http\Controllers\AppointmentController::class, 'create'])->name('appointments.create');
Route::post('/appointments/store', [\App\Http\Controllers\AppointmentController::class, 'store'])->name('appointments.store');


Route::middleware(['auth:student'])->group(function () {
    //Rutas de las reservaciones para el alumno
    Route::get('/reservations/student', [\App\Http\Controllers\StudentReservationController::class, 'indexReservations']);
    Route::get('/reservations/student/cancel', [\App\Http\Controllers\StudentReservationController::class, 'indexReservationsCancelled']);
    Route::get('/reservations/student/accept', [\App\Http\Controllers\StudentReservationController::class, 'indexReservationsAccepted']);
    Route::get('/reservations/student/reject', [\App\Http\Controllers\StudentReservationController::class, 'indexReservationsRejected']);
    Route::get('/reservations/student/finish', [\App\Http\Controllers\StudentReservationController::class, 'indexReservationsFinished']);
    Route::post('/reservations/student/{reservation}/cancel', [\App\Http\Controllers\StudentReservationController::class, 'cancel']);
    Route::post('/reservations/student/{reservation}/cancelPostAccepted', [\App\Http\Controllers\StudentReservationController::class, 'cancelPostAccepted']);
    //JSON
    Route::get('/laboratories/{laboratory}/attendants', [App\Http\Controllers\Api\LaboratoryController::class,'attendants']);
    Route::get('/scheduleLaboratory/hours', [App\Http\Controllers\Api\ScheduleController::class,'hours']);
    Route::get('/computerLaboratory/computers', [App\Http\Controllers\Api\ComputerController::class,'computers']);
});

Route::middleware(['auth:attendant'])->group(function () {
    //Rutas de las reservaciones para el encargado
    Route::get('/reservations/attendant', [\App\Http\Controllers\AttendantReservationController::class, 'indexReservations']);
    Route::get('/reservations/attendant/accept', [\App\Http\Controllers\AttendantReservationController::class, 'indexReservationsAceppted']);
    Route::get('/reservations/attendant/reject', [\App\Http\Controllers\AttendantReservationController::class, 'indexReservationsRejected']);
    Route::get('/reservations/attendant/finish', [\App\Http\Controllers\AttendantReservationController::class, 'indexReservationsFinished']);
    Route::post('/reservations/attendant/{reservation}/reject', [\App\Http\Controllers\AttendantReservationController::class, 'reject']);
    Route::post('/reservations/attendant/{reservation}/accept', [\App\Http\Controllers\AttendantReservationController::class, 'accept']);
    Route::post('/reservations/attendant/{reservation}/finish', [\App\Http\Controllers\AttendantReservationController::class, 'finish']);
});

Route::middleware(['auth:web'])->group(function () {
    //Rutas de las reservaciones para el administrador
    Route::get('/reservations', [\App\Http\Controllers\AppointmentController::class, 'index']);
    
});