<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventoController;


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
    return view('auth.login');
});

Route::resource('evento','\App\Http\Controllers\EventoController');
Route::resource('notificacion','\App\Http\Controllers\NotificacionController');
Route::get('verEvento','\App\Http\Controllers\NotificacionController@verEvento');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
]);//->group(function () {
   // Route::get('/evento', function () {
    //    return view('evento.index');
    //})->name('evento');
//});


