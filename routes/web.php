<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\reservasiController;
use App\Http\Controllers\kamarController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\pengunjungController;
use App\Http\Controllers\pembayaranController;


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

Auth::routes();

// Reservasi
Route::resource('reservasi',reservasiController::class);
Route::post('/reservasi/checkout', [reservasiController::class, 'checkoutReservation'])->name('checkoutReservation');
Route::resource('kamar',kamarController::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//pengunjung
Route::get('/search/customer', [App\Http\Controllers\HomeController::class, 'search'])->name('search');
Route::resource('/pengunjung', pengunjungController::class );
Route::get('cari/pengunjung', [pengunjungController::class, 'cari'])->name('pengunjung.cari');

// Pembayaran
Route::resource('/pembayaran', pembayaranController::class);
Route::get('cari/pembayaran', [pembayaranController::class, 'cari'])->name('pembayaran.cari');
Route::get('history/transaksi', [pembayaranController::class, 'history'])->name('pembayaran.history');


// Kamar

Route::resource('kamar',kamarController::class);
Route::post('/kamar/tipe/store', [kamarController::class, 'tipe_store'])->name('tipe.store');
Route::put('/kamar/tipe/{id}', [kamarController::class, 'tipe_update'])->name('tipe.update');
Route::post('/kamar/tipe/{id}', [kamarController::class, 'tipe_destroy'])->name('tipe.destroy');

