<?php

use App\Http\Controllers\admin\ModulesController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\admin\UserController;

use App\Http\Controllers\DistributorController;
use App\Http\Controllers\RetailerController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\ImageController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\UserAddressController;
use App\Http\Controllers\UserDocumentsController;
use App\Http\Controllers\admin\PasswordController;

use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/candidate-register', [WelcomeController::class, 'candidate_register']);

Route::middleware(['web'])->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});

Route::get('/reset-password', [PasswordController::class,'resetPasswordForm']);
Route::post('/reset-password', [PasswordController::class, 'resetPassword']);

Route::group(['middleware' => 'auth:sanctum'], function () {

    Route::post('/register', [RegisterController::class, 'register'])->name('register');

    Route::resource('/admin', AdminController::class);
    Route::get('/getAdminTableData', [AdminController::class, 'getAdminTableData'])->name('getAdminTableData');

    Route::resource('/distributor', DistributorController::class);
    Route::get('/getDistributorTableData', [DistributorController::class, 'getDistributorTableData'])->name('getDistributorTableData');

    Route::resource('/retailer', RetailerController::class);
    Route::get('/getRetailerTableData', [RetailerController::class, 'getRetailerTableData'])->name('getRetailerTableData');

    Route::resource('/users', UserController::class);

    Route::post('/image-upload', [ProfileController::class, 'profileImageUpload']);
    Route::patch('/basic-details-update', [ProfileController::class, 'BasicDetailsStoreOrUpdate']);
    Route::patch('/bank-details-update', [ProfileController::class, 'BankDetailsStoreOrUpdate']);
    Route::patch('/professional-details-update', [ProfileController::class, 'ProfessionalDetailsStoreOrUpdate']);
    Route::post('/kyc-details-add', [ProfileController::class, 'KycDetailsStore']);
    Route::post('/kyc-details-update', [ProfileController::class, 'KycDetailsUpdate']);
});

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard']);
    Route::get('/home', [App\Http\Controllers\DashboardController::class, 'dashboard']); //redirect to dashboard if already logged in

    Route::resource('user-profile', UserProfileController::class);
    Route::resource('user-address', UserAddressController::class);
    Route::resource('user-documents', UserDocumentsController::class);
});

Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');