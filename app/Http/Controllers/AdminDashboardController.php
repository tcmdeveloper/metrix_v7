<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function showDashbord()
    {
        return view(route('admin.dashboard.show'));
    }
}
