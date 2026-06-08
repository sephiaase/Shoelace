<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PersediaanController;
use App\Http\Controllers\KategoriBarangController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LaporanController;

/*
|--------------------------------------------------------------------------
| LOGIN
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.process');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

/*
|--------------------------------------------------------------------------
| PROTECTED
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get(
        '/',
        [DashboardController::class, 'index']
    )->name('dashboard');

    Route::get(
        '/persediaan',
        [PersediaanController::class, 'index']
    )->name('persediaan');

    Route::resource(
        'kategori',
        KategoriBarangController::class
    );

    Route::resource(
        'barang',
        BarangController::class
    );

    Route::resource(
        'barang-masuk',
        BarangMasukController::class
    );

    Route::resource(
        'user',
        UserController::class
    );

    Route::get(
        '/laporan',
        [LaporanController::class, 'index']
    )->name('laporan');

    Route::get(
        '/laporan/pdf',
        [LaporanController::class, 'pdf']
    )->name('laporan.pdf');

});