<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;

Route::controller(SiteController::class)->group(function(){
    Route::get('/', 'viewHome');
});
