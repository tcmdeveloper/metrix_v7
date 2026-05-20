<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Butschster\Head\Facades\Meta;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{

    // -----------------------------------------------------
    // SHOW LOGIN FORM
    // -----------------------------------------------------


    public function showSignInForm()
    {
        Meta::setTitle('Sign in - True Crime Metrix');

        return view('auth.login', [
            'pageHeadings' => ['Sign in', 'Use your Google account or enter your email & password manually.'],
            'containerClass' => null
        ]);
    }




    // -----------------------------------------------------
    // AUTHENTICATE USER FOR LOGIN
    // -----------------------------------------------------


    public function authenticate(LoginRequest $request) : RedirectResponse
    {

        // 1. Get validated credentials
        $credentials = $request->validated();

        // 2. Remember me option
        $remember = $request->boolean('remember');

        // 3. Attempt login
        if (Auth::attempt($credentials, $remember)) {

            // Prevent session (security best practice)
            $request->session()->regenerate();
            
            return redirect()
                ->intended(route('profile.show'))
                ->with('success', 'Welcome back!');
        }

        // 4. Failed login (generic message for security)
        return back()
            ->withErrors([
                'credentials' => 'Invalid email or password. Please try again.',
            ])
            ->onlyInput('email');



    }



    // -----------------------------------------------------
    // LOGIN WITH EMAIL
    // -----------------------------------------------------

    public function loginWithEmail()
    {
        return redirect()->route('login');
    }



}
