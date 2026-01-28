<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\SuratKeluarController;
use App\Http\Controllers\DisposisiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

Route::get("/hash/{text}", function ($text) {
    return Hash::make($text);
});

Route::get('/', function () {
    return Auth::check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::group(['prefix' => 'users'], function () {
        Route::get('/', [UserController::class, 'index'])->name('users.index');
        Route::post('/store', [UserController::class, 'store'])->name('users.store');
        Route::put('/update/{id}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/delete/{id}', [UserController::class, 'destroy'])->name('users.delete');
    });

    Route::group(['prefix' => 'surat-masuk'], function () {
        Route::get('/', [SuratMasukController::class, 'index'])->name('surat-masuk.index');
        Route::get('/disposisi/{id}', [SuratMasukController::class, 'disposisi'])->name('surat-masuk.disposisi');
        Route::post('/store', [SuratMasukController::class, 'store'])->name('surat-masuk.store');
        Route::put('/update/{id}', [SuratMasukController::class, 'update'])->name('surat-masuk.update');
        Route::delete('/delete/{id}', [SuratMasukController::class, 'destroy'])->name('surat-masuk.delete');
    });

    Route::group(['prefix' => 'surat-keluar'], function () {
        Route::get('/', [SuratKeluarController::class, 'index'])->name('surat-keluar.index');
        Route::get('/disposisi/{id}', [SuratKeluarController::class, 'disposisi'])->name('surat-keluar.disposisi');
        Route::post('/store', [SuratKeluarController::class, 'store'])->name('surat-keluar.store');
        Route::put('/update/{id}', [SuratKeluarController::class, 'update'])->name('surat-keluar.update');
        Route::delete('/delete/{id}', [SuratKeluarController::class, 'destroy'])->name('surat-keluar.delete');
    });

    Route::group(['prefix' => 'disposisi'], function () {
        Route::post('/store', [DisposisiController::class, 'store'])->name('disposisi.store');
    });

    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/print', [LaporanController::class, 'print'])->name('laporan.print');

});

require __DIR__ . '/auth.php';
