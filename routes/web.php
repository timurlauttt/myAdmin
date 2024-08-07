<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SupirsController;
use App\Http\Controllers\SupirController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\CustomerDashboardController;
use App\Http\Controllers\DashboardUtamaController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ActivityLogController;

// Welcome Page
Route::view('/', 'welcome');

// Index Dashboard Utama di Halaman Admin
Route::get('/dashboard', [DashboardUtamaController::class, 'index'])->name('dashboard');

// Files Storage
Route::resource('files', FileController::class);

// User/Admin Authentication and Profile Management
Route::controller(AuthController::class)->group(function () {
    Route::get('admin/register', 'showAdminRegisterForm')->name('admin.register');
    Route::post('admin/register', 'registerAdmin')->name('admin.register.save');
    Route::get('admin/login', 'showAdminLoginForm')->name('admin.login');
    Route::post('admin/login', 'loginAdmin')->name('admin.login.action');
    Route::get('/profile/edit', 'editProfile')->name('profile.edit');
    Route::post('/profile', 'updateProfile')->name('profile.update');
    Route::get('admin/logout', 'logoutAdmin')->middleware('auth')->name('admin.logout');
    Route::get('/profile', 'profile')->name('profile.index');
    Route::get('/activity_logs', [ActivityLogController::class, 'index'])->name('activity_logs.index');

});

// Karyawan
Route::prefix('supir')->controller(SupirsController::class)->group(function () {
    Route::get('', 'index')->name('supirs.index');
    Route::get('create', 'create')->name('supirs.create');
    Route::post('store', 'store')->name('supirs.store');
    Route::get('show/{id}', 'show')->name('supirs.show');
    Route::get('edit/{id}', 'edit')->name('supirs.edit');
    Route::put('edit/{id}', 'update')->name('supirs.update');
    Route::delete('destroy/{id}', 'destroy')->name('supirs.destroy');
});

// Customer/Supir Authentication
Route::controller(CustomerAuthController::class)->group(function () {
    Route::get('/customer/register', 'register')->name('customer.register');
    Route::post('/customer/register', 'registerSave')->name('customer.register.save');
    Route::get('/customer/login', 'login')->name('customer.login');
    Route::post('/customer/login', 'loginAction')->name('customer.login.submit');
    Route::post('/customer/logout', 'logout')->name('customer.logout');
    Route::middleware('auth:customer')->group(function () {
        Route::get('/customer/dashboard', 'dashboard')->name('customers.dashboard');
        Route::get('/customers/profile', [CustomerDashboardController::class, 'profile'])->name('customers.profile');
        Route::get('/customers/edit/{id}', [CustomerDashboardController::class, 'edit'])->name('customers.edit');
        Route::put('/customers/update/{id}', [CustomerDashboardController::class, 'update'])->name('customers.update');
    });
});

// File Printing
Route::get('/files/print/{id}', [FileController::class, 'print'])->name('files.print');

// Customer (Supir) List
Route::get('/customers', [SupirController::class, 'index'])->name('customers.index');

// search admin
Route::get('/search', [SearchController::class, 'search'])->name('search.results');

// profil admin
// Route::get('/customers/profile', [CustomerDashboardController::class, 'profile'])->name('customers.profile');
