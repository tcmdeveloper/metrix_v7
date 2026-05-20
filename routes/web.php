<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CriminalCaseController;
use App\Http\Controllers\ErrorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\YouTubeController;
use App\Livewire\Profile\Edit;
use Illuminate\Support\Facades\Route;



/**************************************************************************
|
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
|--------------------------------------------------------------------------
| Key Definitions
|--------------------------------------------------------------------------
|
|   INDEX       List records
|   VIEW........View single page
|   SHOW........Show single record
|   CREATE......Show form for creating a record
|   STORE.......Save record to the database
|   EDIT........Show form to edit record
|   UPDATE......Save updated record to database
|   DESTROY.....Delete record from database
|
|--------------------------------------------------------------------------
|
**************************************************************************/   



// -----------------------------------------------------
// SITE CONTROLLER
// -----------------------------------------------------


    // ALL USERS

    Route::controller(SiteController::class)->group(function(){

        Route::get('/', 'index')->name('home');
        Route::get('/contact', 'viewContact');
        Route::get('/privacy-policy', 'viewPrivacyPolicy');
        Route::get('/terms-of-service', 'viewTermsOfService');
        Route::post('grab-search-term', 'grabSearchTerm');
        Route::get('/search/{search_term}', 'searchResults');

    });




//


    //

    Route::controller(ErrorController::class)->group(function(){

        Route::get('/abort/403', 'showErrorAbort403');

    });




// -----------------------------------------------------
// REGISTER CONTROLLER
// -----------------------------------------------------


    // GUEST USERS 

    Route::controller(RegisterController::class)->middleware('guest')->group(function(){
        
        Route::post('/register/store', 'register')->name('register.store');
        Route::get('/register', 'showCreateForm')->name('register');

    });




// -----------------------------------------------------
// LOGIN CONTROLLER
// -----------------------------------------------------


    // GUEST USERS 

    Route::controller(LoginController::class)->middleware('guest')->group(function(){
        
        Route::post('/login/authenticate', 'authenticate')->name('login.authenticate');
        Route::get('/login/email', 'loginWithEmail')->name('login.email');
        Route::get('/login', 'showSignInForm')->name('login');

    });




// -----------------------------------------------------
// EMAIL VERIFICATION CONTROLLER
// -----------------------------------------------------


    // AUTHENTICATED USERS

    Route::controller(EmailVerificationController::class)->middleware('auth')->group(function(){

        Route::get('/email/verify', 'showEmailVerification')->middleware('auth')->name('verification.notice');
        Route::get('/email/verify/{id}/{hash}', 'verifyEmail')->middleware(['auth', 'signed'])->name('verification.verify');
        Route::post('/email/verification-notification', 'sendVerificationEmail')->name('verification.send');
        Route::post('/email/verify-email-change', 'sendVerificationEmail/{token}')->name('verification.change');

    });




// -----------------------------------------------------
// PASSWORD RESET CONTROLLER
// -----------------------------------------------------


    // GUEST USERS 

    Route::controller(PasswordResetController::class)->middleware('guest')->group(function(){

        Route::post('/update-password', 'updatePassword')->name('password.update');
        Route::get('/reset-password', 'showResetPasswordForm')->name('password.reset');
        Route::post('/send-password-email', 'sendResetLinkEmail')->name('password.email');
        Route::get('/forgot-password', 'showForgotPasswordForm')->name('password.request');
        
    });




// -----------------------------------------------------
// LOGOUT CONTROLLER
// -----------------------------------------------------


    // GUEST USERS 

    Route::controller(LogoutController::class)->middleware('auth')->group(function(){
        
        Route::post('/logout', 'logout')->name('logout');

    });




// -----------------------------------------------------
// GOOGLE CONTROLLER
// -----------------------------------------------------


    // ALL USERS 

    Route::controller(GoogleController::class)->group(function(){
        
        Route::get('/auth/google', 'redirect');
        Route::get('/auth/google/callback', 'callback');
        
    });




// -----------------------------------------------------
// USER CONTROLLER
// -----------------------------------------------------


    // GUEST USERS

    Route::controller(UserController::class)->middleware('guest')->group(function(){        

    });


    // AUTHENTICATED USERS

    Route::controller(UserController::class)->middleware('auth')->group(function(){

    });




// -----------------------------------------------------
// PROFILE CONTROLLER
// -----------------------------------------------------


    // AUTHENTICATED USERS

    Route::controller(ProfileController::class)->middleware('auth')->group(function(){

        Route::put('/profile', 'update');
        Route::put('/profile/password', 'password');
        Route::post('/profile/avatar', 'avatar');
        Route::get('/profile/edit', Edit::class)->name('profile.edit');
        Route::get('/profile', 'show')->name('profile.show');

    });
    
    


// -----------------------------------------------------
// CRIMINAL CASE CONTROLLER
// -----------------------------------------------------


    // ALL USERS

    Route::controller(CriminalCaseController::class)->group(function(){

        Route::get('/criminal-cases', 'index');
        Route::get('/criminal-cases/{criminal_case}/documents/{document}', 'showDocumentPages');
        Route::get('/criminal-cases/{criminal_case}/documents', 'showDocuments');
        Route::get('/criminal-cases/{criminal_case}', 'show');
    
    });


    // AUTHENTICATED USERS

    Route::controller(CriminalCaseController::class)->middleware(['auth', 'verified'])->group(function(){
        
    });




// -----------------------------------------------------
// VIDEO CONTROLLER
// -----------------------------------------------------


    // ALL USERS

    Route::controller(VideoController::class)->group(function(){

        Route::post('videos/download/submit', 'submitFormData');
        Route::get('videos/download', 'showDownloadForm');
        Route::get('videos', 'index');

    });


    // AUTHENTICATED USERS

    Route::controller(VideoController::class)->middleware('guest')->middleware('auth')->group(function(){
        
    });




// -----------------------------------------------------
// YOUTUBE CONTROLLER
// -----------------------------------------------------


    // ALL USERS

    Route::controller(YouTubeController::class)->group(function(){

        Route::get('youtube/connect', 'redirectToGoogle');
        Route::get('/youtube/callback', 'handleGoogleCallback');
        Route::get('/youtube/channel', 'channel');
        Route::get('/youtube/live/chat', 'showLiveChatList');
        Route::get('/youtube/data/show', 'showData');

    });


    // AUTHENTICATED USERS

    Route::controller(YouTubeController::class)->middleware('auth')->group(function(){

    });




// -----------------------------------------------------
// ADMIN DASHBOARD CONTROLLER
// -----------------------------------------------------


    Route::prefix('admin')
        ->name('admin.')
        ->controller(AdminDashboardController::class)
        ->middleware(['auth', 'is_admin'])
        ->group(function () {

            Route::get('/dashboard', 'showDashbord')
                ->name('dashboard.show');

            
        });