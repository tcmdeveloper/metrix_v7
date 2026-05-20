<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{


    // SHOW PROFILE

    public function show(){

        $user = Auth::user();
        $user->newEmail = $user->email;

        return view('profile.show', [
            'pageHeadings' => [
                'Profile',
                'View and edit your profile here.'
            ],
            'user' => $user,
        ]);

    }



    // SHOW EDIT PROILE FORM

    public function showEditProfileForm(){

        return view('profile.edit', [
            'pageHeadings' => [
                'Edit profile',
                'Edit your profile and click Save changes.'
            ],
            'user' => Auth::user()
        ]);
        
    }




}
