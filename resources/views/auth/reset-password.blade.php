<x-layout.template :page-headings="$pageHeadings">



    @if(session()->has('success'))

        <div
            x-data="{ show: true }"
            x-show="show"
            x-transition
            class="alert-success"
        >
            {{ session('success') }}
        </div>

        <x-cards.form class="card access-card">
            <a href="{{ route('home') }}" class="btn hover:text-white!">
                Back to homepage
            </a>
        </x-cards.form>

    @else


        {{-- Open form-card component --}}

        <x-cards.form class="card access-card">


            {{-- Reset password form --}}

            <div
                x-data="{
                    open: @js(request()->routeIs('reset.password')),
                    showForm() {
                        this.open = true
                        this.$nextTick(() => {
                            this.$refs.email?.focus()
                        })
                    }
                }"
                x-init="
                    if (open) {
                        $nextTick(() => $refs.email?.focus())
                    }
                "
            >


            <div
                x-data="{ open: true }"
                x-init="
                    if (open) {
                        $nextTick(() => $refs.email?.focus())
                    }
                "
            >

                <form 
                    action="{{ route('password.update') }}"
                    method="POST"
                    x-show="open"
                    x-transition
                    novalidate
                >

                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">
                    <input type="hidden" name="email" value="{{ $email }}">

                    <div class="form-field">
                        <label for="email">New password</label>

                        <input
                            x-ref="password"
                            type="password"
                            name="password"
                            id="password"
                        >

                    </div>

                    <div class="form-field">
                        <label for="email">Confirm new password</label>

                        <input
                            type="password"
                            name="password_confirmation"
                            id="password_confirmation"
                        >

                    </div>



                    <div class="form-buttons mt-4">
                        <button type="submit" class="btn">
                            Save new password
                        </button>
                    </div>
                </form>

            </div>

        </x-cards.form>
        
    @endif

</x-layout.template>

