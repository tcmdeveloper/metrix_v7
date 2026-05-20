<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    
    // -----------------------------------------------------
    // LOG USER OUT
    // -----------------------------------------------------


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect( route('login') )
            ->with('status', [
                'type' => 'success',
                'message' => 'You\'ve been logged out successfully.',
            ]);

    }

    
}
