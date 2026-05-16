<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\CompanyController as AdminCompanyController;
use App\Http\Controllers\Admin\JobController as AdminJobController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Candidate\ApplicationController as CandidateApplicationController;
use App\Http\Controllers\Candidate\CandidateDashboardController;
use App\Http\Controllers\Candidate\CvController as CandidateCvController;
use App\Http\Controllers\Candidate\SavedJobController;
use App\Http\Controllers\Employer\ApplicationController as EmployerApplicationController;
use App\Http\Controllers\Employer\CompanyController as EmployerCompanyController;
use App\Http\Controllers\Employer\EmployerDashboardController;
use App\Http\Controllers\Employer\JobController as EmployerJobController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/jobs', [PublicController::class, 'jobs'])->name('jobs.index');
Route::get('/jobs/{job}', [PublicController::class, 'jobShow'])->name('jobs.show');
Route::get('/companies', [PublicController::class, 'companies'])->name('companies.index');
Route::get('/companies/{company}', [PublicController::class, 'companyShow'])->name('companies.show');

Route::get('/dashboard', function () {
    $role = auth()->user()->role;

    return match ($role) {
        'admin' => redirect()->route('admin.dashboard'),
        'employer' => redirect()->route('employer.dashboard'),
        default => redirect()->route('candidate.dashboard'),
    };
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:candidate'])->prefix('candidate')->name('candidate.')->group(function () {
    Route::get('/dashboard', [CandidateDashboardController::class, 'index'])->name('dashboard');
    Route::resource('/cvs', CandidateCvController::class);
    Route::get('/applications', [CandidateApplicationController::class, 'index'])->name('applications.index');
    Route::post('/jobs/{job}/apply', [CandidateApplicationController::class, 'store'])->name('jobs.apply');
    Route::get('/saved-jobs', [SavedJobController::class, 'index'])->name('saved-jobs.index');
    Route::post('/jobs/{job}/save', [SavedJobController::class, 'store'])->name('jobs.save');
    Route::delete('/jobs/{job}/unsave', [SavedJobController::class, 'destroy'])->name('jobs.unsave');
});

Route::middleware(['auth', 'role:employer'])->prefix('employer')->name('employer.')->group(function () {
    Route::get('/dashboard', [EmployerDashboardController::class, 'index'])->name('dashboard');
    Route::resource('/company', EmployerCompanyController::class)->only(['index', 'store', 'update']);
    Route::resource('/jobs', EmployerJobController::class);
    Route::get('/jobs/{job}/applications', [EmployerApplicationController::class, 'index'])->name('jobs.applications');
    Route::get('/applications/{application}', [EmployerApplicationController::class, 'show'])->name('applications.show');
    Route::patch('/applications/{application}/status', [EmployerApplicationController::class, 'updateStatus'])->name('applications.status');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
    Route::patch('/users/{user}/toggle-status', [AdminUserController::class, 'toggleStatus'])->name('users.toggle-status');
    Route::get('/companies', [AdminCompanyController::class, 'index'])->name('companies.index');
    Route::patch('/companies/{company}/status', [AdminCompanyController::class, 'updateStatus'])->name('companies.status');
    Route::get('/jobs', [AdminJobController::class, 'index'])->name('jobs.index');
    Route::patch('/jobs/{job}/status', [AdminJobController::class, 'updateStatus'])->name('jobs.status');
    Route::resource('/categories', AdminCategoryController::class)->except(['show']);
});

require __DIR__.'/auth.php';
