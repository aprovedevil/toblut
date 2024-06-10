<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use Inertia\Inertia;
use App\Http\Controllers\{
    ProfileController,
    AdminController,
    DaftarController,
    GuruController,
    ManajemenNilaiController,
    MaterPelajaranController,
    MaterSiswaController,
    NilaiSiswaController,
    SiswaController,
    RolesController
};

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->middleware('redirectusertype')->name('dashboard');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // User registration route
    Route::get('/pendaftaran', [DaftarController::class, 'index'])
        ->name('user.pendaftaran')
        ->middleware('redirectusertype');
});

// Admin specific routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/roles', [RolesController::class, 'index'])->name('roles.index');
});

// Guru specific routes
Route::middleware(['auth', 'guru'])->group(function () {
    Route::get('/guru/dashboard', [GuruController::class,'index'])->name('guru.dashboard');
    Route::get('/guru/manajemen', [ManajemenNilaiController::class,'index'])->name('guru.manajemen');
    Route::get('/guru/materi', [MaterPelajaranController::class,'index'])->name('guru.materi');
});

// Siswa specific routes
Route::middleware(['auth', 'siswa'])->group(function () {
    Route::get('/siswa/dashboard', [SiswaController::class, 'index'])->name('siswa.dashboard');
    Route::get('/siswa/materi', [MaterSiswaController::class, 'index'])->name('siswa.materi');
    Route::get('/siswa/nilai', [NilaiSiswaController::class, 'index'])->name('siswa.nilai');
});

require __DIR__.'/auth.php';
