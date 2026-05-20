<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\EmailChangeRequest;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;


class EmailVerificationController extends Controller
{

    // -----------------------------------------------------
    // SHOW EMAIL VERIFICATION
    // -----------------------------------------------------


    public function showEmailVerification()
    {
        return view('auth.verify-email');
    }




    // -----------------------------------------------------
    // VERIFY EMAIL ADDRESS
    // -----------------------------------------------------


    public function verifyEmail(EmailVerificationRequest $request)
    {
        $request->fulfill();
        
        return redirect(route('profile.show'))
            ->with('status', [
                'type' => 'success',
                'message' => 'Your email address is now verified.'
            ]);
        
    }




    // -----------------------------------------------------
    // SEND VERIFICATION EMAIL
    // -----------------------------------------------------

    
    public function sendVerificationEmail(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }




    // -----------------------------------------------------
    // SEND EMAIL CHANGE VERIFICATION EMAIL 
    // -----------------------------------------------------


    public function sendEmailChangeVerificationEmail(string $token)
    {
        $request = EmailChangeRequest::where('token', $token)->firstOrFail();

        $user = $request->user;

        $user->email = $request->new_email;
        $user->email_verified_at = now();
        $user->save();

        $request->delete();

        return redirect(route('profile.show'))->with('success', 'Email updated!');
        
    }

}
