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

    // Resident
    Route::get('/s/resident', "SeniorController@resident")->name('resident');

    /**
     * Divisi Keamanan
     */
    // Usroh
    Route::get('/s/d-usroh', "Divman\UsrohController@index")->name('divman.usroh');
    Route::get('/s/d-usroh/tambah', "Divman\UsrohController@tambah")->name('divman.usroh.tambah');
    Route::post('/s/d-usroh/tambah', "Divman\UsrohController@tambahUsroh")->name('divman.usroh.tambah');
    Route::get('/s/d-usroh/{id}', "Divman\UsrohController@detail")->name('divman.usroh.detail');

    // Kamar
    Route::get('/s/d-kamar', "Divman\KamarController@index")->name('divman.kamar');

    // Tahun
    Route::get('/s/d-tahun', "Divman\TahunController@index")->name('divman.tahun');
    Route::post('/s/d-tahun/add', "Divman\TahunController@tambahTahun")->name('divman.tahun.add');
    Route::post('/s/d-tahun/set', "Divman\TahunController@setTahun")->name('divman.tahun.set');
    Route::post('/s/d-tahun/delete', "Divman\TahunController@hapusTahun")->name('divman.tahun.delete');      
});


/**
 * Honey Pot
 */
Route::get('/login', function () {
    return view('pot.login');
})->name('login');

Route::post('/login', function () {
    return view('pot.login');
})->name('login.post');

Route::get('/admin', function () {
    return redirect('/login');
})->name('admin');
/**
 * End Honey Pot
 */