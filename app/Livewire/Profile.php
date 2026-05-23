<?php

namespace App\Livewire;

use App\Mail\VerifyNewEmailMail;
use App\Models\EmailChangeRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Monarobase\CountryList\CountryListFacade;
use Livewire\Component;


class Profile extends Component
{
    public array $form = [
        'first_name' => '',
        'last_name' => '',
        'fullName' => '',
        'newEmail' => '',
        'username' => '',
        'country_code' => '',
        'state_code' => '',
    ];

    // Dropdown data
    public array $countries = [];
    public array $states = [];

    public bool $usernameAlreadySet = false;


    public bool $editing = false;



private function countries(): array
{
    return CountryListFacade::getList('en');
}

private function states(): array
{
    return config('states');
}

    // Here

    public function mount()
    {
        $user = Auth::user();

        $this->form['username'] = $user->username;
        $this->form['newEmail'] = $user->email;
        $this->form['first_name'] = $user->first_name;
        $this->form['last_name'] = $user->last_name;
        $this->form['fullName'] = $user->fullName;
        $this->form['country_code'] = $user->country_code;
        $this->form['state_code'] = $user->state_code;  
    }




    public function saveName()
    {
        $this->validate([
            'form.first_name' => ['nullable', 'string', 'min:2', 'max:20', 'regex:/^[\p{L}]+(?:[ \'\-][\p{L}]+)*$/u'],
            'form.last_name' => ['nullable', 'string', 'min:2', 'max:30', 'regex:/^[\p{L}]+(?:[ \'\-][\p{L}]+)*$/u'],
        ], [
            // First name
            'form.first_name.string' => 'Invalid input format for first name',
            'form.first_name.min' => 'First name must be at least 2 characters long.',
            'form.first_name.max' => 'First name cannot be more than 20 characters long.',
            'form.first_name.regex' => 'Please enter a valid first name.',

            // Last name
            'form.last_name.string' => 'Invalid input format for last name',
            'form.last_name.min' => 'Last name must be at least 2 characters long.',
            'form.last_name.max' => 'Last name cannot be more than 30 characters long.',
            'form.last_name.regex' => 'Please enter a valid first name.',
        ]);

        $user = Auth::user();

        $user->update([
            'country_code' => $this->form['country_code'],
            'state_code' => $this->form['state_code'],
            'first_name' => $this->form['first_name'],
            'last_name' => $this->form['last_name'],
        ]);

        if ($user->email !== $this->form['newEmail']) {
            $emailChangeRequest = EmailChangeRequest::create([
                'user_id' => auth()->id(),
                'new_email' => $this->form['newEmail'],
                'token' => Str::random(64),
            ]);

            Mail::to($emailChangeRequest->new_email)
                ->send(new VerifyNewEmailMail($emailChangeRequest));
        }


    }




    public function save()
    {
        $this->validate([
            'form.newEmail' => ['required', 'email:rfc,dns', Rule::unique('users', 'email')->ignore(auth()->id())],
            'form.username' => ['nullable', 'min:3', 'max:20', 'alpha_dash', Rule::unique('users', 'username')->ignore(auth()->id())],
            'form.first_name' => ['nullable', 'string', 'min:2', 'max:20', 'regex:/^[\p{L}]+(?:[ \'\-][\p{L}]+)*$/u'],
            'form.last_name' => ['nullable', 'string', 'min:2', 'max:30', 'regex:/^[\p{L}]+(?:[ \'\-][\p{L}]+)*$/u'],
            'form.country_code' => ['nullable', 'string', 'max:2', Rule::in(array_keys($this->countries()))],
            'form.state_code' => ['nullable', 'string', 'max:2', Rule::in(array_keys($this->states()))],
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
        $data = [
            'pageHeadings' => [
                'Profile',
                'View and edit your profile here.'
            ],
            'user' => Auth::user(),
        ];

        return view('profile.show', $data)
            ->layout('components.layout.template', $data);
    }


    public function edit()
{
    $this->editing = true;
}

public function cancelEdit()
{
    
    $this->editing = false;
}




    // // as

    // public function edit($field)
    // {
    //     $this->editingField = $field;
    // }




//     // Pop

//     public function cancel()
// {
//     $this->resetValidation();
//     $this->resetEditingState();
// }




    // // Sweets

    // public function resetEditingState()
    // {
    //     $this->editingField = null;

    //     $this->name = $this->user->name;
    //     $this->email = $this->user->email;
    //     $this->bio = $this->user->bio;
    // }




    // // Saving one field

    // public function saveField($field)
    // {
    //     $this->validateOnly($field, [
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|email|unique:users,email,' . $this->user->id,
    //         'bio' => 'nullable|string|max:1000',
    //     ]);

    //     $this->user->update([
    //         $field => $this->{$field},
    //     ]);

    //     $this->editingField = null;
    // }


}