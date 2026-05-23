{{-- resources/views/auth/login.blade.php --}}


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
            } elseif ($errors->has('password') || $errors->has('credentials')) {
                $focusField = 'password';
            } else {
                $focusField = 'email';
            }
        @endphp



        <x-autofocus-errors :field="$focusField" route="login">


            <form
                action="{{ route('login.authenticate') }}"
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

                    @if (! $errors->has('email'))
                        @error('password')
                            <p class="form-error">{{ $message }}</p>
                        @enderror

                        @error('credentials')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    @endif

                </div>


                {{-- Remember me --}}

                <div class="form-field">

                    <label
                        for="remember"
                        class="flex items-center gap-3 cursor-pointer select-none"
                    >

                        <input
                            id="remember"
                            type="checkbox"
                            name="remember"
                            value="1"
                            class="peer sr-only"
                            {{ old('remember') ? 'checked' : '' }}
                        >

                        <div
                            class="
                                flex items-center justify-center
                                w-5 h-5
                                rounded
                                border border-stone-300
                                bg-white
                                transition-colors

                                peer-focus:ring-2
                                peer-focus:ring-blue-200

                                peer-checked:bg-blue-500
                                peer-checked:border-blue-500
                            "
                        >
                            <x-heroicon-o-check
                                class="
                                    w-4 h-4
                                    text-white
                                    opacity-0
                                    transition-opacity
                                    peer-checked:opacity-100
                                "
                            />
                        </div>

                        <span class="text-sm text-stone-600">
                            Remember me
                        </span>

                    </label>

                </div>


                {{-- Submit button --}}

                <div class="form-buttons">

                    <button 
                        type="submit" 
                        class="btn btn-primary w-full"
                    >
                        Sign in
                    </button>

                </div>


                {{-- Links --}}

                <div class="form-links items-start text-left">
                    
                    <a 
                        href="{{ route('password.request') }}" 
                        class="link"
                    >
                        Forgot your password?
                    </a>

                    <a 
                        href="{{ route('register') }}"
                        class="link"    
                    >
                        Create an account
                    </a>
                    
                </div>


            </form>


        </x-autofocus-errors>


    </x-cards.form>


</x-layout.template>