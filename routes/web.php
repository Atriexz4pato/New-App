<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AssessorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


//student routes
Route::middleware(['auth','role:student'])->group(function () {
    Route::get('student/dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');
    Route::post('/students/{id}/upload-acceptance-letter', [StudentController::class, 'uploadAcceptanceLetter'])->name('upload.acceptance_letter');

});


//assessor routes
Route::middleware(['auth','role:assessor'])->group(function () {
    Route::get('assessor/dashboard', [AssessorController::class, 'dashboard'])->name('assessor.dashboard');
});

//admin routes

Route::middleware(['auth','role:admin'])->group(function () {
   Route::get('admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});

require __DIR__.'/auth.php';
