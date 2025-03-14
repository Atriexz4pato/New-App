<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AssessorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
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
   //manage assessors
   Route::get('/admin/new_assessor', [AssessorController::class, 'createAssessor'])->name('admin.new_assessor');
   Route::get('/admin/assessors', [AdminController::class, 'manageAssessors'])->name('admin.manage_assessors');
   Route::post('/admin/new_assessor', [AdminController::class, 'storeAssessor'])->name('admin.store_new_assessor');
   Route::delete('/admin/assessors/{id}', [AdminController::class, 'destroyAssessor'])->name('admin.destroy');
   Route::get('/admin/assessors/{assessor}/edit', [AdminController::class, 'editAssessor'])->name('admin.edit_assessor');
   Route::put('/admin/assessors/{assessor}', [AdminController::class, 'updateAssessor'])->name('admin.update_assessor');

   //students
    Route::get('admin/students', [AdminController::class, 'manageStudents'])->name('admin.manage_students');
});


require __DIR__.'/auth.php';
