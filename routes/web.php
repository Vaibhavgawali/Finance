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

use App\Http\Controllers\CreditCardController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\DematController;
use App\Http\Controllers\InsuranceController;

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

Route::get('/', [WelcomeController::class, 'index']);

Route::get('/credit', [WelcomeController::class, 'credit']);
// Route::get('/creditcard', [WelcomeController::class, 'credit_card']);

Route::get('/loanForm', [WelcomeController::class, 'loan']);
Route::get('/dematForm', [WelcomeController::class, 'demat']);
Route::get('/loan-service', [WelcomeController::class, 'loan_service']);

Route::get('/general-insurance', [WelcomeController::class, 'general_insurance']);
Route::get('/life-insurance', [WelcomeController::class, 'life_insurance']);
Route::get('/health-insurance', [WelcomeController::class, 'health_insurance']);

Route::middleware(['web'])->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});

Route::get('/register', [WelcomeController::class, 'register']);
Route::post('/register', [RegisterController::class, 'register'])->name('register');

Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::get('/reset-password', [PasswordController::class, 'resetPasswordForm']);
Route::post('/reset-password', [PasswordController::class, 'resetPassword']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard']);
    Route::get('/home', [App\Http\Controllers\DashboardController::class, 'dashboard']); //redirect to dashboard if already logged in
});


Route::group(['middleware' => 'auth:sanctum'], function () {

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

    Route::get('/getCreditCardTableData', [CreditCardController::class, 'getCreditCardTableData'])->name('getCreditCardTableData');
    Route::get('/getLoanTableData', [LoanController::class, 'getLoanTableData'])->name('getLoanTableData');
    Route::get('/getDematTableData', [DematController::class, 'getDematTableData'])->name('getDematTableData');
    Route::get('/getInsuranceTableData', [InsuranceController::class, 'getInsuranceTableData'])->name('getInsuranceTableData');

    Route::get('get-role/{id}', [UserController::class, 'getUserRoles']);
    Route::post('assign-role/{id}', [UserController::class, 'assignRole']);

    Route::patch('demat-update-status/{id}', [DematController::class, 'updateStatus']);
    Route::patch('loan-update-status/{id}', [LoanController::class, 'updateStatus']);
    Route::patch('insurance-update-status/{id}', [InsuranceController::class, 'updateStatus']);
    Route::patch('credit-card-update-status/{id}', [CreditCardController::class, 'updateStatus']);
});

Route::resource('/credit-card', CreditCardController::class);
Route::resource('/loan', LoanController::class);
Route::resource('/demat', DematController::class);
Route::resource('/insurance', InsuranceController::class);

Route::post('/insurance/callback', [InsuranceController::class, 'insuranceCallback'])->name('insuranceCallback');
Route::get('/policy-status', [InsuranceController::class, 'policyStatus'])->name('policyStatus');
