{{-- resources/views/auth/forgot-password.blade.php --}}


<x-layout.template :page-headings="$pageHeadings">


    <x-cards.form class="auth-card">


        @if (session('status.type') === 'success')
  
            <a 
                href="{{ route('home') }}" 
                class="btn-primary w-full">
                Back to homepage
            </a>

        @else

            <x-autofocus-errors field="email" route="password.request">

                <form
                    action="{{ route('password.email') }}"
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


                    {{-- Submit button --}}

                    <div class="form-buttons">

                        <button 
                            type="submit" 
                            class="btn btn-primary w-full"
                        >
                            Continue
                        </button>

                    </div>


                    {{-- Links --}}

                    <div class="form-links items-start text-left">
                        
                        <a 
                            href="{{ route('login') }}" 
                            class="link"
                        >
                            Back to login
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


        @endif


    </x-cards.form>


</x-layout.template>