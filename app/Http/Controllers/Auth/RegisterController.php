<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Services\RandomStringGenerator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    

    // -----------------------------------------------------
    // SHOW REGISTRATION FORM
    // -----------------------------------------------------


    public function showCreateForm()
    {
        return view('auth.register', [
            'pageHeadings' => [
                'Create account',
                'Use your Google account or enter your email & password manually.'
            ]
        ]);
    }


    
    
    // -----------------------------------------------------
    // STORE NEW USER IN DATABASE
    // -----------------------------------------------------


    public function register(RandomStringGenerator $generator, RegisterRequest $request)
    {
        // 1. Get validated data (already validated by RegisterRequest)
        $data = $request->validated();

        // 2. Create user
        $user = User::create([
            'hex' => $generator->makeHex(),
            'username' => strtolower($data['username']),
            'display_name' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        // 3. Trigger Laravel registration event (optional but recommended)
        event(new Registered($user));

        // 4. Send verification email
        $user->sendEmailVerificationNotification();

        // 5. Log user in
        Auth::login($user);

        // 6. Redirect
        return redirect()
            ->route('profile.show')
            ->with('status', [
                'type' => 'success',
                'message' => 'Welcome! Your account has been created successfully.'
            ]);

    }


}
