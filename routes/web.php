<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\LaporanLabaRugi;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});

Route::get('/token', function () {
    return csrf_token();
});

Route::prefix("home")->group(function() {
    Route::get('/',[HomeController::class, 'index'])->name('home');
    Route::get('/getAllData',[HomeController::class, 'getAllDataDashboard'])->name('home/getAllData');
});

Route::prefix("barang")->group(function() {
    Route::get('/',[BarangController::class, 'index'])->name('barang');
    Route::get('/getAllData',[BarangController::class, 'getAllData'])->name('barang/getAllData');
    Route::post('/create',[BarangController::class, 'create'])->name('barang/create');
    Route::get('/detailById',[BarangController::class, 'getDataById'])->name('barang/detailById');
    Route::post('/edit',[BarangController::class, 'edit'])->name('barang/edit');
    Route::post('/delete',[BarangController::class, 'delete'])->name('barang/delete');
});

Route::prefix("pembelian")->group(function() {
    Route::get('/',[PembelianController::class, 'index'])->name('pembelian');
    Route::get('/getAllData',[PembelianController::class, 'getAllData'])->name('pembelian/getAllData');
    Route::post('/create',[PembelianController::class, 'create'])->name('pembelian/create');
});

Route::prefix("penjualan")->group(function() {
    Route::get('/',[PenjualanController::class, 'index'])->name('penjualan');
    Route::get('/getAllData',[PenjualanController::class, 'getAllData'])->name('penjualan/getAllData');
    Route::post('/create',[PenjualanController::class, 'create'])->name('penjualan/create');
});

Route::prefix("laporan")->group(function() {
    Route::get('/',[LaporanLabaRugi::class, 'index'])->name('laporan');
    Route::get('/getAllData',[LaporanLabaRugi::class, 'getAllData'])->name('laporan/getAllData');
});

Auth::routes();

