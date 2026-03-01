<x-layout.template :page-headings="$pageHeadings">

    <x-cards.form class="form-card-md">

        <form action="/authenticate" method="POST">

            @csrf


            {{-- EMAIL --}}

            <div class="form-field">

                <input
                    type="email"
                    name="email"
                    placeholder="Email address"
                    value="{{$errors->has('email') ? '' : old('email')}}"
                    {{$errors->has('email') ? 'autofocus' : null}}
                >

            </div>


            {{-- Password --}}

            <div class="form-field">

                <input
                    type="password"
                    name="password"
                    placeholder="Password"
                    {{$errors->has('password') ? 'autofocus' : null}}
                >

            </div>


            {{-- Buttons --}}

            <div class="form-buttons">

                <button type="submit" class="btn">
                    Log in
                </button>

            </div>


        </form>

    </x-cards.form>

</x-layout.template>


