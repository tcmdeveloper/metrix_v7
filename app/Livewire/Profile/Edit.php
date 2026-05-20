<?php

namespace App\Livewire\Profile;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\EmailChangeRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Monarobase\CountryList\CountryListFacade;
use App\Mail\VerifyNewEmailMail;


class Edit extends Component
{

    

    public array $form = [
        'first_name' => '',
        'last_name' => '',
        'newEmail' => '',
        'username' => '',
        'country_code' => null,
        'state_code' => null,
    ];

    // Dropdown data
    public array $countries = [];
    public array $states = [];

    public bool $usernameAlreadySet = false;

    




    private function countries(): array
{
    return array_keys(CountryListFacade::getList('en'));
}

private function states(): array
{
    return array_keys(config('states'));
}



    public function updatedFormCountryCode($value)
    {
        if ($value !== 'US') {
            $this->form['state_code'] = null;
        }
    }



    public function mount(): void
    {
        
        $user = Auth::user();

        $this->form['username'] = $user->username;
        $this->form['newEmail'] = $user->email;
        $this->form['first_name'] = $user->first_name;
        $this->form['last_name'] = $user->last_name;
        $this->form['country_code'] = $user->country_code;
        $this->form['state_code'] = $user->state_code;        

    }

    public function save()
    {

        // 1. Validate form input
        
        $this->validate([
            'form.newEmail' => ['required', 'email:rfc,dns', Rule::unique('users', 'email')->ignore(auth()->id())],
            'form.username' => ['nullable', 'min:3', 'max:20', 'alpha_dash', Rule::unique('users', 'username')->ignore(auth()->id())],
            'form.first_name' => ['nullable', 'string', 'min:2', 'max:20', 'regex:/^[\p{L}]+(?:[ \'\-][\p{L}]+)*$/u'],
            'form.last_name' => ['nullable', 'string', 'min:2', 'max:30', 'regex:/^[\p{L}]+(?:[ \'\-][\p{L}]+)*$/u'],
            'form.country_code' => ['nullable', 'string', 'max:2', Rule::in($this->countries())],
            'form.state_code' => ['nullable', 'string', 'max:2', Rule::in($this->states())],
        ], [
            'form.newEmail.required' => 'Please enter your email address.',
            'form.newEmail.email' => 'Please enter a valid email address.',
            'form.newEmail.unique' => 'This email is already in use.',
            'form.username.required' => 'Please enter a username for your account.',
            'form.username.min' => 'Username must be at least 3 characters.',
            'form.username.max' => 'Username cannot be more than 20 characters.',
            'form.username.alpha_dash' => 'Username can only contain letters, numbers, dashes, and underscores.',
            'form.username.unique' => 'That username is not available.',
            'form.first_name.string' => 'Invalid input format for first name',
            'form.first_name.min' => 'First name must be at least 2 characters long.',
            'form.first_name.max' => 'First name cannot be more than 20 characters long.',
            'form.first_name.regex' => 'Please enter a valid first name.',
            'form.last_name.string' => 'Invalid input format for last name',
            'form.last_name.min' => 'Last name must be at least 2 characters long.',
            'form.last_name.max' => 'Last name cannot be more than 30 characters long.',
            'form.last_name.regex' => 'Please enter a valid first name.',
            'form.country_code' => 'There was a problem with the country you selected.',
            'form.state_code' => 'There was a problem with the state you selected.',
        ]);

        
        // 2. Get the currently authenticated user

        $user = Auth::user();

        $user->update([
            'country_code' => $this->form['country_code'],
            'state_code' => $this->form['state_code'],
            'first_name' => $this->form['first_name'],
            'last_name' => $this->form['last_name'],
        ]);   
        

        // 3. Store new email as a change request if user changed their email

        if ($user->email !== $this->form['newEmail']) {
            $emailChangeRequest = EmailChangeRequest::create([
                'user_id' => auth()->id(),
                'new_email' => $this->form['newEmail'],
                'token' => Str::random(64),
            ]);

            Mail::to($emailChangeRequest->new_email)
                ->send(new VerifyNewEmailMail($emailChangeRequest));
        }

        // 4. Update username and display name if added

        if ($this->form['username'] !== $user->username) {
            $user->update([
                'username' => strtolower($this->form['username']),
                'display_name' => $this->form['username']
            ]);
        }
        
        // 5. Set flash message and return to profile

        session()->flash('status', [
            'type' => 'success',
            'message' => 'Your profile has been updated.'
        ]);

        return $this->redirectRoute('profile.show');


    }

    



    

    

    public function render()
    {
        // dd($this->email);
        return view('livewire.profile.edit', [
            'pageHeadings' => [
                'Edit profile',
                'Edit your details and click \'Save changes\'.'
            ],
            'country_code' => $this->form['country_code']
        ])->layout('components.layout.template');
    }
}