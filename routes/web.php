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
    // return view('welcome');
    return redirect("/s");
});

Route::get('/s/login', "Auth\SeniorAuthController@login")->name('senior.login');
Route::post('/s/login', "Auth\SeniorAuthController@postLogin")->name('senior.login.post');
Route::post('/s/passcode-login', "Auth\SeniorAuthController@passcodeLogin")->name('senior.login.passcode');
Route::get('/s/forgot-password', "Auth\SeniorAuthController@forgotPassword")->name('senior.forgotpassword');
Route::post('/s/forgot-password', "Auth\SeniorAuthController@postForgotPassword")->name('senior.forgotpassword.post');
Route::get('/s/reset-password', "Auth\SeniorAuthController@resetPassword")->name('senior.resetpassword');
Route::post('/s/reset-password', "Auth\SeniorAuthController@postResetPassword")->name('senior.resetpassword.post');

Route::middleware('auth:senior')->group(function(){
    Route::get('/s', "DashboardController@index");
    Route::get('/s/logout', "Auth\SeniorAuthController@logout")->name('senior.logout');

    // Senior
    Route::get('/s/senior', "SeniorController@index")->name('senior.senior');
    Route::get('/s/senior/{id}', "SeniorController@detail")->name('senior.senior.detail');
    Route::get('/s/senior-x', "SeniorController@indexX")->name('senior.senior.x');

    // Resident
    Route::get('/s/resident', "ResidentController@index")->name('senior.resident');
    Route::post('/s/resident/tambahpoin', "ResidentController@tambahPoin")->name('senior.resident.poin.tambah');
    Route::get('/s/resident/{id}', "ResidentController@detail")->name('senior.resident.detail');
    Route::post('/s/resident/{id}/edit', "ResidentController@edit")->name('senior.resident.detail.edit');
    Route::get('/s/resident/{id}/poin', "ResidentController@poin")->name('senior.resident.poin');
    Route::get('/s/resident/hapus/{idpoin}', "ResidentController@hapusPoin")->name('senior.resident.poin.hapus');

    // Tengko
    Route::get('/s/tengko', "TengkoController@index")->name('senior.tengko');
    // Route::get('/s/tengko', "TengkoController@search")->name('senior.tengko.cari');
    Route::get('/s/tengko/getpelanggaran/{tipe}', "TengkoController@getPelanggaran")->name('senior.tengko.get');
    
    // Usroh
    Route::get('/s/usroh', "UsrohController@index")->name('senior.usroh');
    Route::get('/s/usroh/{id}', "UsrohController@detail")->name('senior.usroh.detail');
    Route::get('/s/usroh/{id}/{idr}', "UsrohController@resident")->name('senior.usroh.detail.resident');
    Route::get('/s/usroh/{id}/{idr}/poin', "UsrohController@residentPoin")->name('senior.usroh.detail.resident.poin');

    // Profile
    Route::get('/s/profile', "ProfileController@index")->name('senior.profile');
    Route::post('/s/profile/simpan', "ProfileController@simpan")->name('senior.profile.save');

    // Help
    Route::get('/s/about', "HelpController@about")->name('senior.help.about');
    Route::get('/s/contact', "HelpController@contact")->name('senior.help.contact');
    Route::get('/s/privacy', "HelpController@privacy")->name('senior.help.privacy');

    /**
     * Divisi Keamanan
     */
    // Usroh
    Route::get('/s/d-usroh', "Divman\UsrohController@index")->name('divman.usroh');
    Route::get('/s/d-usroh/tambah', "Divman\UsrohController@tambah")->name('divman.usroh.tambah');
    Route::post('/s/d-usroh/tambah', "Divman\UsrohController@tambahUsroh")->name('divman.usroh.tambah');
    Route::post('/s/d-usroh/simpan', "Divman\UsrohController@simpan")->name('divman.usroh.simpan');
    Route::get('/s/d-usroh/hapus/{id}', "Divman\UsrohController@hapus")->name('divman.usroh.hapus');
    Route::get('/s/d-usroh/{id}', "Divman\UsrohController@detail")->name('divman.usroh.detail');

    // Kamar
    Route::get('/s/d-kamar', "Divman\KamarController@index")->name('divman.kamar');
    Route::get('/s/d-kamar/tambah', "Divman\KamarController@tambah")->name('divman.kamar.tambah');
    Route::post('/s/d-kamar/tambah', "Divman\KamarController@tambahKamar")->name('divman.kamar.tambah');
    Route::post('/s/d-kamar/simpan', "Divman\KamarController@simpan")->name('divman.kamar.simpan');
    Route::get('/s/d-kamar/hapus/{id}', "Divman\KamarController@hapus")->name('divman.kamar.hapus');
    Route::get('/s/d-kamar/{id}', "Divman\KamarController@detail")->name('divman.kamar.detail');

    // Senior
    Route::get('/s/d-senior', "Divman\SeniorController@index")->name('divman.senior');
    Route::get('/s/d-senior/tambah', "Divman\SeniorController@tambah")->name('divman.senior.tambah');
    Route::get('/s/d-senior/getkamar/{idusroh}', "Divman\SeniorController@getKamar")->name('divman.senior.getkamar');
    Route::post('/s/d-senior/tambah', "Divman\SeniorController@tambahSenior")->name('divman.senior.tambah');
    Route::post('/s/d-senior/simpan', "Divman\SeniorController@simpan")->name('divman.senior.simpan');
    Route::get('/s/d-senior/hapus/{id}', "Divman\SeniorController@hapus")->name('divman.senior.hapus');
    Route::get('/s/d-senior/{id}', "Divman\SeniorController@detail")->name('divman.senior.detail');

    // Resident
    Route::get('/s/d-resident', "Divman\ResidentController@index")->name('divman.resident');
    Route::get('/s/d-resident/tambah', "Divman\ResidentController@tambah")->name('divman.resident.tambah');
    Route::get('/s/d-resident/getkamar/{idusroh}', "Divman\ResidentController@getKamar")->name('divman.resident.getkamar');
    Route::post('/s/d-resident/tambah', "Divman\ResidentController@tambahResident")->name('divman.resident.tambah');
    Route::post('/s/d-resident/simpan', "Divman\ResidentController@simpan")->name('divman.resident.simpan');
    Route::get('/s/d-resident/hapus/{id}', "Divman\ResidentController@hapus")->name('divman.resident.hapus');
    Route::get('/s/d-resident/import', "Divman\ResidentController@import")->name('divman.resident.import');
    Route::post('/s/d-resident/import', "Divman\ResidentController@verifyImport")->name('divman.resident.import');
    Route::post('/s/d-resident/prosesImport',"Divman\ResidentController@prosesImport")->name('divman.resident.prosesimport');
    Route::get('/s/d-resident/{id}', "Divman\ResidentController@detail")->name('divman.resident.detail');

    // Tengko
    Route::get('/s/d-tengko', "Divman\TengkoController@index")->name('divman.tengko');
    Route::get('/s/d-tengko/tambah', "Divman\TengkoController@tambah")->name('divman.tengko.tambah');
    Route::post('/s/d-tengko/tambah', "Divman\TengkoController@tambahTengko")->name('divman.tengko.tambah');
    Route::post('/s/d-tengko/simpan', "Divman\TengkoController@simpan")->name('divman.tengko.simpan');
    Route::get('/s/d-tengko/hapus/{id}', "Divman\TengkoController@hapus")->name('divman.tengko.hapus');
    Route::get('/s/d-tengko/{id}', "Divman\TengkoController@detail")->name('divman.tengko.detail');

    // Rekap
    Route::get('/s/d-poin', "Divman\PoinController@index")->name('divman.poin');
    Route::get('/s/d-poin/download', "Divman\PoinController@download")->name('divman.poin.download');

    // Tahun
    Route::get('/s/d-tahun', "Divman\TahunController@index")->name('divman.tahun');
    Route::post('/s/d-tahun/add', "Divman\TahunController@tambahTahun")->name('divman.tahun.add');
    Route::post('/s/d-tahun/set', "Divman\TahunController@setTahun")->name('divman.tahun.set');
    Route::post('/s/d-tahun/delete', "Divman\TahunController@hapusTahun")->name('divman.tahun.delete');

    // Pengaturan
    Route::get('/s/d-pengaturan', "Divman\PengaturanController@index")->name('divman.pengaturan');
    Route::get('/s/d-pengaturan/refresh-token', 'Divman\PengaturanController@refreshToken')->name('divman.pengaturan.refresh.token');
    Route::post('/s/d-pengaturan/save-ponsus', "Divman\PengaturanController@savePonsus")->name('divman.pengaturan.save.ponsus');

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