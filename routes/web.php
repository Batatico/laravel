<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController; //Mandarino

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




Route::group(['middleware'=>['auth']], function(){    
    Route::get('/dashboard','App\Http\Controllers\DashboardController@index')->name('dashboard');
    Route::get('/welcome','App\Http\Controllers\DashboardController@giveWelcome')->name('welcome_route');
    Route::get('/lista-alumnos', 'App\Http\Controllers\UserController@show')->name('mostrar_alumnos');
    Route::get('/lista-usuarios', 'App\Http\Controllers\UserController@retornoUsuarios')->name('mostrar_usuarios');
});

//para Alumnos
Route::group(['middleware'=>['auth','role:Alumno']], function(){    
    Route::get('/dashboard/miperfil','App\Http\Controllers\DashboardController@perfil')->name('dashboard.perfil');
});



require __DIR__.'/auth.php';
