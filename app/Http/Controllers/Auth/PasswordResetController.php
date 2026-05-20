<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Butschster\Head\Facades\Meta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class PasswordResetController extends Controller
{

    // -----------------------------------------------------
    // SHOW FORGOT PASSWORD FORM
    // -----------------------------------------------------

    public function showForgotPasswordForm(Request $request)
    {
        Meta::setTitle('Sign in - True Crime Metrix');
        // dd($request);
        return view('auth.forgot-password', [
            'pageHeadings' => ['Forgot your password?', 'Enter your email address to reset your login password.'],
            'containerClass' => null
        ]);
    }




    // -----------------------------------------------------
    // SEND RESET LINK EMAIL
    // -----------------------------------------------------

    public function sendResetLinkEmail(Request $request)
    {

         // 1. Validate form data

        $request->validate([
            'email' => ['required', 'email:rfc,dns'],
        ], [
            'email.required' => 'Enter the email address for your account.',
            'email.email' => 'Please enter a valid email address.',
        ]);


        
        // 2. Attempt to send password reset email and return status response

        $status = Password::sendResetLink(
            $request->only('email')
        );



        // 3. Return response based on password reset status

        return match ($status) {
            Password::RESET_LINK_SENT => back()->with('status', [
                'type' => 'success',
                'message' => 'We\'ve sent a password reset link to your email address.'
            ]),
            Password::RESET_THROTTLED => back()->with('status', [
                'type' => 'warning',
                'message' => 'Please wait before requesting another reset link.'
            ]),
            default => back()->withErrors(['error' => 'We could not send the reset link.']),
        };


    }




    // -----------------------------------------------------
    // SHOW RESET PASSWORD FORM
    // -----------------------------------------------------

    public function showResetPasswordForm(Request $request)
    {
        $token = $request->query('token');
        $email = $request->query('email');

        $pageHeadings = [
            'Reset your password',
            'Enter your new password and click Save.'
        ];

        return view('users.reset-password', compact('token', 'email', 'pageHeadings'));
        
    }




    // -----------------------------------------------------
    // UPDATE PASSWORD
    // -----------------------------------------------------
    
    public function updatePassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only(
                'email',
                'password',
                'password_confirmation',
                'token'
            ),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->save();
            }
        );



        if($status === Password::PASSWORD_RESET){

            $user = User::where('email', $request->email)->first();

            if ($user) {
                Auth::loginUsingId($user->id);
            }

            return redirect( route('profile.show') )
                ->with('status', [
                    'type' => 'success',
                    'message' => 'Your password has been updated successfully.'
                ]);

        }

        return back()->withErrors(['email' => [__($status)]]);
    }
}
