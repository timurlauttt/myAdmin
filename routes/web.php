<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SupirsController;
use App\Http\Controllers\SupirController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\CustomerDashboardController;
use App\Http\Controllers\DashboardUtamaController;

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
});

// Supir Management
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
    });
});

// File Printing
Route::get('/files/print/{id}', [FileController::class, 'print'])->name('files.print');

// Customer (Supir) List
Route::get('/customers', [SupirController::class, 'index'])->name('customers.index');
