<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
{

    // VIEW HOME
    public function viewHome(){
        return view('pages.home');
    }

}
