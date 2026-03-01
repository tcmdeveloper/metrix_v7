<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Butschster\Head\Facades\Meta;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // VIEW LOGIN FORM

    public function viewLoginForm(){

        Meta::setTitle('Log in - True Crime Metrix');

        return view('users.login', [
            'pageHeadings' => ['Login', 'Log in to manage your content.'],
            'containerClass' => null
        ]);
    }




    // AUTHENTICATE USER FOR LOGIN

    public function authenticate(Request $request) : RedirectResponse
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect()->intended('dashboard')->with('toast', 'Welcome back!');
        }
 
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
}
