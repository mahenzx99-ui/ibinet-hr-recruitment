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

// List lowongan
Route::get('/careers', [JobController::class, 'index'])
    ->name('careers.index');

// Detail lowongan
Route::get('/jobs/{slug}', [JobController::class, 'show'])
    ->name('jobs.show');

// Kirim lamaran (form dari halaman job detail)
Route::post('/jobs/{slug}/apply', [ApplicationController::class, 'store'])
    ->name('applications.store');


// =====================
//  PROFILE (USER BIASA, HARUS LOGIN)
// =====================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// =====================
//  ADMIN AREA (HARUS LOGIN)
// =====================
Route::middleware('auth')->prefix('admin')->group(function () {

    // List pelamar + filter
    Route::get('/applications', [ApplicationController::class, 'index'])
        ->name('admin.applications.index');

    // Export Excel (ikut filter query)
    Route::get('/applications/export', [ApplicationController::class, 'export'])
        ->name('admin.applications.export');

    // Detail pelamar
    Route::get('/applications/{application}', [ApplicationController::class, 'show'])
        ->name('admin.applications.show');

    // Update status pelamar (submitted/reviewed/accepted/rejected)
    Route::patch('/applications/{application}/status', [ApplicationController::class, 'updateStatus'])
        ->name('admin.applications.updateStatus');

    // Update catatan HR
    Route::patch('/applications/{application}/notes', [ApplicationController::class, 'updateNotes'])
        ->name('admin.applications.updateNotes');
});


// =====================
//  DASHBOARD (SETELAH LOGIN)
// =====================
// Biar habis login langsung ke halaman admin pelamar
Route::get('/dashboard', function () {
    return redirect()->route('admin.applications.index');
})->middleware(['auth'])->name('dashboard');


// =====================
//  AUTH ROUTES DARI BREEZE
// =====================
require __DIR__.'/auth.php';