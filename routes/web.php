<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//name es para darle un alias a la ruta

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