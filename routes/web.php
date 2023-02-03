<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\reservasiController;
use App\Http\Controllers\kamarController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\pengunjungController;


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

Route::resource('reservasi',reservasiController::class);
Route::resource('kamar',kamarController::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::resource('/pengunjung', pengunjungController::class );
Route::get('pengun/cari', [pengunjungController::class, 'cari'])->name('pengunjung.cari');


