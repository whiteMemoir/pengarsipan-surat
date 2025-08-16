<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\SuratKeluarController;
use App\Http\Controllers\DisposisiController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

    Route::middleware(['superadmin'])->group(function () {
        Route::group(['prefix' => 'users'], function () {
            Route::get('/', [UserController::class, 'index'])->name('users.index');
            Route::post('/store', [UserController::class, 'store'])->name('users.store');
            Route::put('/update/{id}', [UserController::class, 'update'])->name('users.update');
            Route::delete('/delete/{id}', [UserController::class, 'destroy'])->name('users.delete');
        });
    });

    Route::group(['prefix' => 'surat-masuk'], function () {
        Route::get('/', [SuratMasukController::class, 'index'])->name('surat-masuk.index');
        Route::post('/store', [SuratMasukController::class, 'store'])->name('surat-masuk.store');
        Route::put('/update/{id}', [SuratMasukController::class, 'update'])->name('surat-masuk.update');
        Route::delete('/delete/{id}', [SuratMasukController::class, 'destroy'])->name('surat-masuk.delete');
    });

    Route::resource('surat-keluar', SuratKeluarController::class);
    Route::resource('disposisi', DisposisiController::class);
});

require __DIR__ . '/auth.php';
