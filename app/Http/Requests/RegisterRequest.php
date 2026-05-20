<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{

    // -----------------------------------------------------
    // Defines validation rule and form error messages for 
    // user regitration requests.
    // -----------------------------------------------------



    // Determine if the user is authorized to make this request

    public function authorize(): bool
    {
        return true;
    }


    // Get the validation rules that apply to the request

    public function rules(): array
    {
        return [
            'email' => ['required', 'email:rfc,dns', 'unique:users'],
            'username' => ['required', 'min:3', 'max:20', 'alpha_dash', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'max:255', 'confirmed'],
        ];
        
    }


    // Specify error messages

    public function messages(): array
    {
        return [

            // Email
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'Email already in use.',

            // Username
            'username.required' => 'Please enter a username for your account.',
            'username.min' => 'Username must be at least 3 characters.',
            'username.max' => 'Username cannot be more than 20 characters.',
            'username.alpha_dash' => 'Username can only contain letters, numbers, dashes, and underscores.',
            'username.unique' => 'That username is not available.',

            // Password
            'password.required' => 'Please enter a password for your account.',
            'password.string' => 'Please enter a valid password for your account.',
            'password.min' => 'Password must be at least 8 characters.',
            'password.max' => 'Password cannot be more than 255 characters.',
            
        ];
    }

    
}
