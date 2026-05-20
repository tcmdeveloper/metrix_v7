<x-layout.template :page-headings="$pageHeadings">


    {{-- Open form-card component --}}

    <x-cards.form class="card access-card">



        {{-- Button to sign in using Google account --}}

        <a href="{{ url('/auth/google') }}">
            <x-elements.google-signin-button />
        </a>



        {{-- Form or spacer --}}
        
        <div class="form-or-spacer">
            <div></div>
            <span>OR</span>
            <div></div>
        </div>


        @php
            $focusPassword =
                ($errors->has('password') || $errors->has('credentials'))
                && ! $errors->has('email');
        @endphp



        {{-- Sign in form (default hidden) --}}

        <div
            x-data="{ open: @js(request()->routeIs('login')) }"
            x-init="

                if (open) {
                
                    $nextTick(() => {

                        if (@js($focusPassword)) {

                            $refs.password?.focus();

                        } else {

                            $refs.email?.focus();

                            const length = $refs.email.value.length;

                            $refs.email.setSelectionRange(length, length);

                        }

                    })

                }

            "
            
        >


            {{-- Button to show sign in form --}}

            <button
                x-show="!open"
                @click="
                    open = true;
                    $nextTick(() => $refs.email?.focus())
                "
                class="btn"
            >
                Sign in with email
            </button>



            <form
                action="{{ route('login.authenticate') }}"
                method="POST"
                x-show="open"
                x-transition
                novalidate
            >

                @csrf


                {{-- Email --}}
                
                <div class="form-field">
                    <input
                        x-ref="email"
                        type="email"
                        name="email"
                        placeholder="Email address"
                        value="{{ old('email', session('login_email')) }}"
                    >
                </div>



                {{-- Password --}}

                <div class="form-field">
                    <input
                        x-ref="password"
                        type="password"
                        name="password"
                        placeholder="Password"
                    >
                </div>



                {{-- Remember me --}}

                <div class="form-field !mb-4">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" class="peer sr-only">
                        <div
                            class="w-5 h-5 border border-stone-300 bg-white
                                flex items-center justify-center
                                peer-checked:bg-blue-400
                                peer-checked:border-stone-400
                                peer-checked:[&>svg]:opacity-100"
                        >
                            <x-heroicon-o-check class="w-8 h-8 stroke-2 opacity-0 transition-opacity text-white" />
                        </div>
                        <span class="text-stone-500">Remember me</span>
                    </label>
                </div>



                {{-- Buttons --}}

                <div class="form-buttons">
                    <button type="submit" class="btn">
                        Sign in
                    </button>
                </div>



                {{-- Links--}}

                <div class="form-links flex-col">
                    <span>
                        <a href="{{ route('password.request') }}">
                            Forgot your password?
                        </a>
                    </span>
                    <span>
                        <a href="{{ route('register') }}">
                            Create an account
                        </a>
                    </span>
                </div>



            </form>
        

        </div>


    </x-cards.form>


</x-layout.template>


