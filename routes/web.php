<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;

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
    Route::get('admin/dashboard', function () {
        return view('admin/dashboard');
    })->name('admin.dashboard');


    Route::get('admin/user/show', [UserController::class, 'show'])->name('showUsers');
    Route::get('admin/user/create', [UserController::class, 'create'])->name('createUser');
    Route::post('admin/user/store', [UserController::class, 'store'])->name('storeUser');
    Route::get('admin/user/edit/{id}', [UserController::class, 'edit'])->name('editUser');
    Route::put('admin/user/update/{id}', [UserController::class, 'update'])->name('updateUser');
    Route::get('admin/user/view/{id}', [UserController::class, 'view'])->name('viewUser');
    Route::patch('admin/user/archive/{id}', [UserController::class, 'archive'])->name('archiveUser');
});
