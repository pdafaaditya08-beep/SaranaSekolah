<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\KategoriController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class,'showLogin'])->name('login');
Route::post('/login', [AuthController::class,'login']);
Route::post('/logout', [AuthController::class,'logout'])->name('logout');

// Redirect sesuai role

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class,'dashboard'])->name('admin.dashboard');
    Route::resource('kategori', KategoriController::class);
    Route::delete('/admin/aspirasi/{id}', [AdminController::class, 'destroy'])->name('admin.aspirasi.destroy');;
    Route::get('/aspirasi/{id}', [AdminController::class, 'detailAspirasi'])->name('admin.aspirasi.detail');
    Route::post('/aspirasi/{id}/feedback', [AdminController::class, 'addFeedback'])->name('admin.aspirasi.feedback');
    Route::post('/aspirasi/{id}/progress', [AdminController::class, 'addProgress'])->name('admin.aspirasi.progress');
});

Route::prefix('siswa')->group(function () {
    Route::get('/dashboard', [SiswaController::class,'dashboard'])->name('siswa.dashboard');
    Route::get('/aspirasi/create',[SiswaController::class,'createAspirasi'])->name('siswa.aspirasi.create');
    Route::post('aspirasi',[SiswaController::class,'storeAspirasi'])->name('siswa.aspirasi.store');
    Route::get('/aspirasi/{id}',[SiswaController::class,'detailAspirasi'])->name('siswa.aspirasi.detail');
    Route::delete('/siswa/aspirasi/{id}', [SiswaController::class, 'destroy'])->name('siswa.aspirasi.destroy');
});