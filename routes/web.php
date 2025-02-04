<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AdminController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rute untuk user biasa
Route::middleware(['auth'])->group(function () {
    // Profile
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });

    // Absensi (User)
    Route::controller(AttendanceController::class)->group(function () {
        Route::get('/attendance', 'index')->name('attendance.index'); // User melihat absensi
        Route::post('/attendance', 'store')->name('attendance.store'); // User menyimpan absensi
    });
});

// Rute untuk admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    // Absensi (Admin)
    Route::controller(AdminController::class)->group(function () {
        Route::get('/attendance', 'index')->name('admin.attendance'); // Admin melihat semua absensi
        Route::get('/attendance/{attendance}/edit', 'edit')->name('admin.attendance.edit'); // ✨ Tambah rute edit
        Route::put('/attendance/{attendance}', 'updateAttendance')->name('admin.attendance.update'); // Admin update berhasil
        Route::delete('/attendance/{attendance}', 'deleteAttendance')->name('admin.attendance.delete'); // Admin hapus absensi
    });

    // Manajemen User
    Route::controller(AdminController::class)->group(function () {
        Route::get('/users', 'manageUsers')->name('admin.users'); // Admin melihat daftar user
        Route::post('/users/{user}', 'updateUserRole')->name('admin.users.update'); // Admin mengubah role user
    });
});

require __DIR__.'/auth.php';
