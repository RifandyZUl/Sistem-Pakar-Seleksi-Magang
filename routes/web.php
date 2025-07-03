<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\KriteriaController;
use App\Http\Controllers\Hrd\AlternatifController;
use App\Http\Controllers\Hrd\NilaiAlternatifController;
use App\Http\Controllers\Admin\PerhitunganController;
use App\Http\Controllers\Hrd\PerhitunganController as HrdPerhitunganController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman Utama
Route::get('/', function () {
    return view('welcome');
});

// Redirect Dashboard Berdasarkan Role
Route::get('/dashboard', function () {
    $role = \Illuminate\Support\Facades\Auth::user()->role;
    return redirect()->route($role . '.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Authenticated User (semua role)
Route::middleware(['auth'])->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// =====================
// ADMIN Routes
// =====================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', fn() => view('admin.dashboard'))->name('dashboard');

    // CRUD Kriteria
    Route::resource('/kriteria', KriteriaController::class)
        ->names('kriteria')
        ->parameters(['kriteria' => 'kriteria']);

    // Perhitungan (bisa lihat juga)
    Route::get('/perhitungan', [PerhitunganController::class, 'index'])->name('perhitungan');
    Route::get('/perhitungan/pdf', [PerhitunganController::class, 'cetakPDF'])->name('perhitungan.pdf');
});

// =====================
// HRD Routes
// =====================
Route::middleware(['auth', 'role:hrd'])->prefix('hrd')->name('hrd.')->group(function () {
    Route::get('/', [\App\Http\Controllers\Hrd\DashboardController::class, 'index'])->name('dashboard');

    // CRUD Alternatif
    Route::resource('/alternatif', AlternatifController::class)
        ->names('alternatif')
        ->parameters(['alternatif' => 'alternatif']);

    // CRUD Nilai Alternatif
    Route::resource('/nilai', NilaiAlternatifController::class)
        ->names('nilai')
        ->parameters(['nilai' => 'nilai']);

    // Perhitungan (bisa lihat juga)
    Route::get('/perhitungan', [HrdPerhitunganController::class, 'index'])->name('perhitungan');
    Route::get('/perhitungan/pdf', [HrdPerhitunganController::class, 'cetakPDF'])->name('perhitungan.pdf');
});

// Auth routes dari Laravel Breeze
require __DIR__.'/auth.php';
