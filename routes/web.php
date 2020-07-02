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

Route::get('/s/login', "Auth\SeniorAuthController@login")->name('senior.login');
Route::post('/s/login', "Auth\SeniorAuthController@postLogin")->name('senior.login.post');

Route::middleware('auth:senior')->group(function(){
    Route::get('/s', "SeniorController@index");
    Route::get('/s/logout', "Auth\SeniorAuthController@logout");
});

/**
 * Honey Pot
 */
Route::get('/login', function () {
    return view('pot.login');
})->name('login');

Route::get('/admin', function () {
    return redirect('/login');
})->name('admin');
/**
 * End Honey Pot
 */