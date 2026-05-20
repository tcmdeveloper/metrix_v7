<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{

    // -----------------------------------------------------
    // Defines validation rule and form error messages for 
    // user login requests.
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
            'email' => ['required', 'email:rfc,dns'],
            'password' => ['required', 'string'],
        ];
    }


    // Specify error messages

    public function messages(): array
    {
        return [

            // Email
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',

            // Password
            'password.required' => 'Please enter your password.',
            
        ];
    }


}
