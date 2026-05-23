{{-- resources/views/auth/reset-password.blade.php --}}


<x-layout.template :page-headings="$pageHeadings">


    <x-cards.form class="auth-card">

        <x-autofocus-errors field="password" route="password.reset">

            <form
                action="{{ route('password.update') }}"
                method="POST"
                novalidate
                class="space-y-4"
            >

                @csrf

                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="email" value="{{ $email }}">

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

                    @error('password')
                        <p class="form-error">{{ $message }}</p>
                    @enderror

                    @error('credentials')
                        <p class="form-error">{{ $message }}</p>
                    @enderror

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



                <div class="form-buttons">
                    <button type="submit" class="btn btn-primary w-full">
                        Save new password
                    </button>
                </div>

            </form>

            </x-autofocus-errors>

        </x-cards.form>
        
</x-layout.template>

