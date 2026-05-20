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
            $focusEmail =
                $errors->has('email')
                || !$errors->any();

            $focusUsername =
                !$errors->has('email')
                && ($errors->has('username'));

            $focusPassword =
                (!$errors->has('email') && !$errors->has('username'))
                && ($errors->has('password'));

                // dd($focusUsername);
        @endphp
      



        {{-- Sign in form (default hidden) --}}

        <div
            x-data="{ open: @js(request()->routeIs('register')) }"
            x-init="

                if (open) {
            
                    $nextTick(() => {

                        if (@js($focusEmail)) {
                            $refs.email?.focus();

                            const length = $refs.email.value.length;
                            $refs.email.setSelectionRange(length, length);
                        }

                        if (@js($focusUsername)) {
                            $refs.username?.focus();

                            const length = $refs.username.value.length;
                            $refs.username.setSelectionRange(length, length);
                        }

                        if (@js($focusPassword)) {
                            $refs.password?.focus();
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
                action="{{ route('register.store') }}"
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
                        value="{{ old('email') }}"
                    >
                </div>



                {{-- Username --}}
                
                <div class="form-field">
                    <input
                        x-ref="username"
                        type="text"
                        name="username"
                        placeholder="Username"
                        value="{{ old('username') }}"
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



                {{-- Confirm password --}}

                <div class="form-field">
                    <input
                        x-ref="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        placeholder="Confirm password"
                    >
                </div>



                {{-- Buttons --}}

                <div class="form-buttons">
                    <button type="submit" class="btn">
                        Create account
                    </button>
                </div>



                {{-- Links--}}

                <div class="form-links col-span-2 justify-center">
                    <span>
                        Already have an account?
                        <a href="{{ route('login') }}" class="blue-link">
                            Sign in
                        </a>
                    </span>
                </div>



            </form>
        

        </div>


    </x-cards.form>


</x-layout.template>


