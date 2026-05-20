<x-layout.template :page-headings="$pageHeadings">



    @if (session('status.type') === 'success')

        <x-cards.form class="card access-card">
            <a href="{{ route('home') }}" class="btn hover:text-white!">
                Back to homepage
            </a>
        </x-cards.form>

    @else
    
        {{-- Open form-card component --}}

        <x-cards.form class="card access-card" novalidate>


            {{-- Forgot password form (default hidden) --}}

            <div
                x-data="{
                    open: @js(request()->routeIs('password.request')),
                    showForm() {
                        this.open = true
                        this.$nextTick(() => {
                            this.$refs.email?.focus()
                        })
                    }
                }"
                x-init="
                    if (open) {
                        $nextTick(() => {

                            $refs.email?.focus();

                            const length = $refs.email.value.length;

                            $refs.email.setSelectionRange(length, length);

                        })
                    }
                "
                
            >

                <form 
                    action="{{ route('password.email') }}"
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



                    <!-- Form Buttons -->
                    
                    <div class="form-buttons">
                        <button type="submit" class="btn">
                            Continue
                        </button>
                    </div>



                </form>


            </div>


        </x-cards.form>

    @endif


</x-layout.template>