<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\JobController;

// =====================
//  DISABLE REGISTER
// =====================
Route::redirect('/register', '/login');


// =====================
//  PUBLIC PAGES (TANPA LOGIN)
// =====================
Route::get('/', function () {
    return view('home', [
        'title' => 'Home | IBINET',
    ]);
});

Route::get('/about', function () {
    return view('about', [
        'title' => 'About | IBINET',
        'nama'  => 'mahen',
    ]);
});

Route::get('/blog', function () {
    return view('blog', [
        'title' => 'Blog | IBINET',
    ]);
});

Route::get('/contact', function () {
    return view('contact', [
        'title' => 'Contact | IBINET',
    ]);
});


// =====================
//  CAREER & JOB ROUTES (PUBLIC)
// =====================

// List lowongan
Route::get('/careers', [JobController::class, 'index'])
    ->name('careers.index');

// Detail lowongan
Route::get('/jobs/{slug}', [JobController::class, 'show'])
    ->name('jobs.show');

// HALAMAN FORM LAMAR (GET)
Route::get('/jobs/{slug}/apply', [ApplicationController::class, 'create'])
    ->name('jobs.apply.form');

// PROSES SIMPAN LAMARAN (POST)
Route::post('/jobs/{slug}/apply', [ApplicationController::class, 'store'])
    ->name('jobs.apply');


// =====================
//  PROFILE (HARUS LOGIN)
// =====================
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});


// =====================
//  ADMIN AREA (HARUS LOGIN)
// =====================
// Instruksi: Tambahkan tepat di bawah middleware admin:
// Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () { ... });

Route::middleware(['auth'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // ===== APLIKASI / PELAMAR =====
        // Daftar pelamar
        Route::get('/applications', [ApplicationController::class, 'index'])
            ->name('applications.index');

        // Export Excel
        Route::get('/applications/export', [ApplicationController::class, 'export'])
            ->name('applications.export');

        // Detail pelamar
        Route::get('/applications/{application}', [ApplicationController::class, 'show'])
            ->name('applications.show');

        // Update status pelamar
        Route::patch('/applications/{application}/status', [ApplicationController::class, 'updateStatus'])
            ->name('applications.updateStatus');

        // Update catatan HR
        Route::patch('/applications/{application}/notes', [ApplicationController::class, 'updateNotes'])
            ->name('applications.updateNotes');

        // ===== JOBS (STATUS OPEN/CLOSE) =====
        // Kelola lowongan (admin jobs list)
        Route::get('/jobs', [JobController::class, 'adminIndex'])
            ->name('jobs.index');

        // Update status open/closed
        Route::patch('/jobs/{job}/status', [JobController::class, 'updateStatus'])
            ->name('jobs.updateStatus');
    });


// =====================
//  DASHBOARD (SETELAH LOGIN)
// =====================
Route::get('/dashboard', function () {
    // nama route tetap "admin.applications.index"
    return redirect()->route('admin.applications.index');
})->middleware(['auth'])->name('dashboard');


// =====================
//  ROUTE AUTH BREEZE
// =====================
require __DIR__.'/auth.php';
