<?php

use App\Http\Controllers\ActivityLogsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AppConfigController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\HomeownerController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\OwnershipTransfersController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\WaterReadingController;

Route::get('/', function () {
    return view('index');
});

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('submitLogin', [LoginController::class, 'authenticate'])->name('submitLogin');
Route::post('submitOtp', [LoginController::class, 'submitOtp'])->name('submitOtp');
Route::post('reset_password', [LoginController::class, 'forgotPassword'])->name('reset_password');
Route::post('verify_otp', [LoginController::class, 'verifyOtp'])->name('verify_otp');
Route::post('/update_password', [LoginController::class, 'updatePassword'])->name('update_password');
Route::match(['post', 'get'], 'logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register/send-otp', [RegisterController::class, 'sendOtp'])->name('register.sendOtp');
Route::post('/submit', [RegisterController::class, 'register'])->name('submit');

Route::get('/download', function(){
    return view('download');
});

Route::middleware(['role:admin'])->group(function () {
    Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('admin/user/show', [UserController::class, 'show'])->name('showUsers');
    Route::get('admin/user/create', [UserController::class, 'create'])->name('createUser');
    Route::post('admin/user/store', [UserController::class, 'store'])->name('storeUser');
    Route::get('admin/user/edit/{id}', [UserController::class, 'edit'])->name('editUser');
    Route::put('admin/user/update/{id}', [UserController::class, 'update'])->name('updateUser');
    Route::get('admin/user/view/{id}', [UserController::class, 'view'])->name('viewUser');
    Route::patch('admin/user/archive/{id}', [UserController::class, 'archive'])->name('archiveUser');

    Route::get('admin/user/user_activity', [ActivityLogsController::class, 'index'])->name('user_activity');

    Route::get('admin/homeowner/index', [HomeownerController::class, 'index'])->name('admin.homeowner.index');
    Route::get('admin/homeowner/pending', [HomeownerController::class, 'pending'])->name('admin.homeowner.pending');
    Route::post('admin/homeowner/approved_registration/{id}', [HomeownerController::class, 'approveRegistration'])->name('admin.homeowner.approve_registration');
    Route::post('admin/homeowner/reject_registration/{id}', [HomeownerController::class, 'rejectRegistration'])->name('admin.homeowner.reject_registration');
    Route::post('admin/homeowner/request_update_profile/{id}', [HomeownerController::class, 'requestUpdateProfile'])->name('admin.homeowner.request_update_profile');
    Route::get('admin/homeowner/show/{id}', [HomeownerController::class, 'show'])->name('admin.homeowner.show');

    Route::get('admin/ownership/index', [OwnershipTransfersController::class, 'index'])->name('admin.ownership.index');
    
    Route::get('admin/complaint/index', [ComplaintController::class, 'index'])->name('admin.complaint.index');
    Route::patch('admin/complaint/update/{id}', [ComplaintController::class, 'update'])->name('admin.complaint.update');
    
    Route::get('admin/maintenance/index', [MaintenanceController::class, 'index'])->name('admin.maintenance.index');
    Route::patch('admin/maintenance/update/{id}', [MaintenanceController::class, 'update'])->name('admin.maintenance.update');

    Route::get('admin/water_reading/index', [WaterReadingController::class, 'index'])->name('admin.water_reading.index');

    Route::get('admin/billing/index', [BillingController::class, 'index'])->name('admin.billing.index');
    Route::get('admin/billing/create', [BillingController::class, 'create'])->name('admin.billing.create');
    Route::post('admin/billing/billing', [BillingController::class, 'store'])->name('admin.billing.store');

    Route::get('admin/app_config', [AppConfigController::class, 'index'])->name('admin.app_config.index');
    Route::get('admin/app_config/edit', [AppConfigController::class, 'edit'])->name('admin.app_config.edit');
    Route::post('admin/app_config/update', [AppConfigController::class, 'update'])->name('admin.app_config.update');
});

Route::middleware(['role:homeowner'])->group(function () {
    Route::get('homeowner/dashboard', function(){
        return view('homeowner.dashboard');
    });
});
