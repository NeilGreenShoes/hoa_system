<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AppConfigController;

Route::get('/', function () {
    return view('index');
});

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('submitLogin', [LoginController::class, 'authenticate'])->name('submitLogin');
Route::post('submitOtp', [LoginController::class, 'submitOtp'])->name('submitOtp');
Route::post('reset_password', [LoginController::class, 'forgotPassword'])->name('reset_password');
Route::post('verify_otp', [LoginController::class, 'verifyOtp'])->name('verify_otp');
Route::match(['post', 'get'], 'logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['role:admin'])->group(function () {
    Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('admin/user/show', [UserController::class, 'show'])->name('showUsers');
    Route::get('admin/user/create', [UserController::class, 'create'])->name('createUser');
    Route::post('admin/user/store', [UserController::class, 'store'])->name('storeUser');
    Route::get('admin/user/edit/{id}', [UserController::class, 'edit'])->name('editUser');
    Route::put('admin/user/update/{id}', [UserController::class, 'update'])->name('updateUser');
    Route::get('admin/user/view/{id}', [UserController::class, 'view'])->name('viewUser');
    Route::patch('admin/user/archive/{id}', [UserController::class, 'archive'])->name('archiveUser');

    Route::get('admin/app_config', [AppConfigController::class, 'index'])->name('admin.app_config.index');
    Route::get('admin/app_config/edit', [AppConfigController::class, 'edit'])->name('admin.app_config.edit');
    Route::post('admin/app_config/update', [AppConfigController::class, 'update'])->name('admin.app_config.update');
});
