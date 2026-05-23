{{-- resources/views/auth/register.blade.php --}}


<x-layout.template :page-headings="$pageHeadings">


    <x-cards.form class="auth-card">


        {{-- Social login --}}

        <a
            href="{{ url('/auth/google') }}"
            class="block"
            aria-label="Sign in with Google"
        >
            <x-elements.google-signin-button />
        </a>


        {{-- Divider --}}
        
        <div class="form-or-spacer" aria-hidden="true">
            <div></div>
            <span>OR</span>
            <div></div>
        </div>

        
        @php
            if ($errors->has('email')) {
                $focusField = 'email';
            } elseif ($errors->has('username')) {
                $focusField = 'username';
            } elseif ($errors->has('password')) {
                $focusField = 'password';
            } else {
                $focusField = 'email';
            }
        @endphp
      


        <x-autofocus-errors :field="$focusField" route="register">


            <form
                action="{{ route('register.store') }}"
                method="POST"
                novalidate
                class="space-y-4"
            >

                @csrf


                {{-- Email --}}

                <div class="form-field">

                    <label
                        for="email"
                        class="sr-only"
                    >
                        Email address
                    </label>

                    <input
                        x-ref="email"
                        id="email"
                        type="text"
                        inputmode="email"
                        name="email"
                        placeholder="Email address"
                        value="{{ old('email', session('login_email')) }}"
                        @class([
                            'input',
                            'input-error' => $errors->has('email')
                        ])
                    >

                    @error('email')
                        <p class="form-error">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Username --}}

                <div class="form-field">

                    <label
                        for="username"
                        class="sr-only"
                    >
                        Username
                    </label>

                    <input
                        x-ref="username"
                        id="username"
                        type="text"
                        inputmode="text"
                        name="username"
                        placeholder="Username"
                        value="{{ old('username') }}"
                        @class([
                            'input', 
                            'input-error' => $errors->has('username')
                        ])
                    >

                    @if (! $errors->has('email'))
                        @error('username')
                            <p class="form-error">
                                {{ $message }}
                            </p>
                        @enderror
                    @endif

                </div>


                
                {{-- Password --}}

                <div class="form-field">

                    <label
                        for="password"
                        class="sr-only"
                    >
                        Password
                    </label>

                    <input
                        x-ref="password"
                        id="password"
                        type="password"
                        name="password"
                        placeholder="Password"
                        @class([
                            'input',
                            'input-error' => $errors->has('password') || $errors->has('credentials')
                        ])
                    >

                    @if (! $errors->has('email') && ! $errors->has('username'))
                        @error('password')
                            <p class="form-error">{{ $message }}</p>
                        @enderror

                        @error('credentials')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    @endif

                </div>


                {{-- Confirm password --}}

                <div class="form-field">

                    <label
                        for="password_confirmation"
                        class="sr-only"
                    >
                        Confirm password
                    </label>

                    <input
                        x-ref="password_confirmation"
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        placeholder="Confirm password"
                        @class([
                            'input',
                            'input-error' => $errors->has('password') || $errors->has('credentials')
                        ])
                    >

                </div>


                {{-- Submit button --}}

                <div class="form-buttons">

                    <button 
                        type="submit"
                        class="btn btn-primary w-full"
                    >
                        Create account
                    </button>

                </div>


                {{-- Links --}}

                <div class="form-links items-center text-center">

                    <span class="font-medium">Already have an account?</span>

                    <a
                        href="{{ route('login') }}"
                        class="link inline-flex w-auto"
                    >
                        Sign in
                    </a>
                    
                </div>

                


            </form>
        

        </x-autofocus-errors>


    </x-cards.form>


</x-layout.template>


