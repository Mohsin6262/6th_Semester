<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\JobController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AdminController;

// ✅ Redirect root URL to login
Route::get('/', function () {
    return redirect()->route('login');
});

// 🔐 Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// 👤 Registration
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

// 🏠 Dashboard (after login)
Route::get('/dashboard', function () {
    if (!Session::has('user')) return redirect()->route('login');
    return view('dashboard');
})->name('dashboard');

// 👤 Profile
Route::get('/profile', [AuthController::class, 'showProfile'])->name('profile');
Route::post('/profile', [AuthController::class, 'updateProfile'])->name('profile.update');

// 💼 Job Routes
Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
Route::get('/apply/{job}', [JobController::class, 'showApplyForm'])->name('jobs.apply');
Route::post('/apply/{job}', [JobController::class, 'submitApplication'])->name('jobs.apply.submit');
Route::get('/jobs/create', [JobController::class, 'create'])->name('jobs.create');
Route::post('/jobs/store', [JobController::class, 'store'])->name('jobs.store');

// 📥 Employer: Manage Applications
Route::get('/employer/applications', [ApplicationController::class, 'index'])->name('employer.applications');
Route::post('/employer/applications/{id}/approve', [ApplicationController::class, 'approve'])->name('employer.applications.approve');
Route::post('/employer/applications/{id}/reject', [ApplicationController::class, 'reject'])->name('employer.applications.reject');

// 📄 Jobseeker: View My Applications
Route::get('/my-applications', [ApplicationController::class, 'myApplications'])->name('jobseeker.applications');


//admin
Route::get('/admin', [AdminController::class, 'index'])->name('admin.page');
Route::post('/admin/employer/{id}', [AdminController::class, 'updateEmployer'])->name('admin.update.employer');
Route::post('/admin/application/{id}', [AdminController::class, 'updateApplication'])->name('admin.update.application');

//companyname
Route::post('/employer/company-name', [AuthController::class, 'updateCompanyName'])->name('employer.update.company');
