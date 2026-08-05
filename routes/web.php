<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\SpjController;
use App\Http\Controllers\VerifikasiController;
use App\Http\Controllers\PimpinanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\NotificationController;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['auth'])->group(function () {

    // Dashboard - semua role bisa akses
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Notifikasi - semua role bisa akses
    Route::get('notifications',[NotificationController::class,'index'])
        ->name('notification.index');

    Route::get('notifications/read/{notification}',[NotificationController::class,'read'])
        ->name('notification.read');

    Route::post('notifications/read-all',[NotificationController::class,'readAll'])
        ->name('notification.readAll');

    // ============================
    // ADMIN ONLY
    // ============================
    Route::middleware(['role:admin'])->group(function () {

        Route::resource('users', UserController::class);

        Route::resource('kegiatan', KegiatanController::class);

        Route::get('/verifikasi', [VerifikasiController::class, 'index'])
            ->name('verifikasi.index');

        Route::get('/verifikasi/{spj}', [VerifikasiController::class, 'show'])
            ->name('verifikasi.show');

        Route::put('/verifikasi/{spj}', [VerifikasiController::class, 'update'])
            ->name('verifikasi.update');

    });

    // ============================
    // ADMIN & USER
    // ============================
    Route::middleware(['role:admin,user'])->group(function () {

        Route::resource('spj', SpjController::class);

    });

    // ============================
    // PIMPINAN ONLY
    // ============================
    Route::middleware(['role:pimpinan'])->group(function () {

        Route::get('/pimpinan', [PimpinanController::class,'index'])
            ->name('pimpinan.index');

        Route::get('/pimpinan/{spj}', [PimpinanController::class,'show'])
            ->name('pimpinan.show');

        Route::put('/pimpinan/{spj}', [PimpinanController::class,'update'])
            ->name('pimpinan.update');

    });

    // ============================
    // ADMIN & PIMPINAN
    // ============================
    Route::middleware(['role:admin,pimpinan'])->group(function () {

        Route::get('/laporan', [LaporanController::class, 'index'])
            ->name('laporan.index');

        Route::get('/laporan/pdf', [LaporanController::class, 'pdf'])
            ->name('laporan.pdf');

        Route::get('laporan/export/excel', [LaporanController::class, 'exportExcel'])
            ->name('laporan.export.excel');

    });

});