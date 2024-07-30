<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SupirsController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\CustomerDashboardController;

// welcome page ------------------------------------------------------------------------------------------ welcome page //
Route::get('/', function () {
    return view('welcome');
});
// welcome page ------------------------------------------------------------------------------------------ welcome page //


// files storage ------------------------------------------------------------------------------------------ files storage //
Route::resource('files', FileController::class);
Route::get('files/{file}', [FileController::class, 'show'])->name('files.show');
// files storage ------------------------------------------------------------------------------------------ files storage //


// user/admin ------------------------------------------------------------------------------------------ user/admin //
Route::controller(AuthController::class)->group(function () {
    Route::get('admin/register', 'showAdminRegisterForm')->name('admin.register');
    Route::post('admin/register', 'registerAdmin')->name('admin.register.save');

    Route::get('admin/login', 'showAdminLoginForm')->name('admin.login');
    Route::post('admin/login', 'loginAdmin')->name('admin.login.action');

    Route::get('admin/logout', 'logoutAdmin')->middleware('auth')->name('admin.logout');
});
// user/admin ------------------------------------------------------------------------------------------ user/admin //


// files ------------------------------------------------------------------------------------------ files //
Route::middleware('auth')->group(function () {
    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::controller(SupirsController::class)->prefix('supir')->group(function () {
        Route::get('', 'index')->name('supirs');
        Route::get('create', 'create')->name('supirs.create');
        Route::post('store', 'store')->name('supirs.store');
        Route::get('show/{id}', 'show')->name('supirs.show');
        Route::get('edit/{id}', 'edit')->name('supirs.edit');
        Route::put('edit/{id}', 'update')->name('supirs.update');
        Route::delete('destroy/{id}', 'destroy')->name('supirs.destroy');
    });
    Route::middleware(['auth:customer'])->group(function () {
        Route::get('/customer/dashboard', [CustomerAuthController::class, 'dashboard'])->name('customer.dashboard');
    });
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
});
// files ------------------------------------------------------------------------------------------ files //


// customer/supir ------------------------------------------------------------------------------------------ customer/supir //
// Routes untuk autentikasi customer
Route::get('/customer/register', [CustomerAuthController::class, 'register'])->name('customer.register');
Route::post('/customer/register', [CustomerAuthController::class, 'registerSave'])->name('customer.register.save');
Route::get('/customer/login', [CustomerAuthController::class, 'login'])->name('customer.login');
Route::post('/customer/login', [CustomerAuthController::class, 'loginAction'])->name('customer.login.submit');
Route::post('/customer/logout', [CustomerAuthController::class, 'logout'])->name('customer.logout');

// Routes yang memerlukan autentikasi customer
Route::middleware(['auth:customer'])->group(function () {
    Route::get('/customer/dashboard', [CustomerAuthController::class, 'dashboard'])->name('customer.dashboard');
});

// print data di dashboard utama
Route::middleware('auth:customer')->group(function () {
    Route::get('/customer/dashboard', [CustomerAuthController::class, 'dashboard'])->name('customer.dashboard');
    Route::post('/files/markAsPrinted/{id}', [CustomerAuthController::class, 'markAsPrinted'])->name('files.markAsPrinted');
});
Route::resource('files', FileController::class);
Route::get('/files/print/{id}', [FileController::class, 'printFile'])->name('print2');
// Route::get('/files/markAsPrinted/{id}', [App\Http\Controllers\CustomerAuthController::class, 'markAsPrinted'])->name('files.markAsPrinted');