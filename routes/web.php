<?php

use App\Http\Controllers\CriminalCaseController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UserController;
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




// SITE CONTROLLER 


    // ALL USERS

    Route::controller(SiteController::class)->group(function(){

        Route::get('/', 'index');
        Route::get('/about', 'viewAbout');
        Route::get('/support', 'viewSupport');
        Route::get('/contact', 'viewContact');
        Route::get('/opportunities', 'viewOpportunities');
        Route::get('/privacy-policy', 'viewPrivacyPolicy');
        Route::get('/terms-of-service', 'viewTermsOfService');
        Route::post('grab-search-term', 'grabSearchTerm');
        Route::get('/search/{search_term}', 'searchResults');

    });





// USER CONTROLLER


    // AUTHENTICATED USERS

    Route::controller(UserController::class)->middleware('auth')->group(function(){

        Route::post('/logout', 'logout');

    });


    // GUEST USERS

    Route::controller(UserController::class)->middleware('guest')->group(function(){

        Route::get('/login', 'viewLoginForm')->name('login');
        Route::post('/authenticate', 'authenticate');

    });


    


// CRIMINAL CASE CONTROLLER


    // ALL USERS

    Route::controller(CriminalCaseController::class)->group(function(){

        Route::get('/criminal-cases', 'index');
        Route::get('/criminal-cases/{criminal_case}/documents/{document}', 'showDocumentPages');
        Route::get('/criminal-cases/{criminal_case}/documents', 'showDocuments');
        Route::get('/criminal-cases/{criminal_case}', 'show');
    
    });