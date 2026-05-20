<div>

    <x-cards.page-headings :page-headings="$pageHeadings" />


    <x-cards.form class="card">

    

        <form wire:submit.prevent="save" class="space-y-6" novalidate>

            @if(Auth::user()->username)
                
                {{-- START: Username field (disabled) --}}

                    <div x-data="{ show: false, timer: null }" class="form-field">

                        <label class="flex justify-between mb-1 text-sm font-medium">
                            Username
                        </label>

                        <input
                            type="text"
                            value="{{ auth()->user()->username }}"
                            readonly
                            placeholder="Username"
                            class="!w-full !rounded-md !border !border-gray-300 !bg-gray-100 !px-4 !py-3 !text-gray-500 !cursor-not-allowed"
                            @click="
                                show = true;
                                {{-- clearTimeout(timer); --}}
                                {{-- timer = setTimeout(() => show = false, 2000); --}}
                            "
                        />

                        <span
                            x-cloak
                            x-show="show"
                            class="mt-1! text-sm! text-red-600!"
                        >
                            You can't change your username
                        </span>

                    </div>

                {{-- END: Username field (disabled) --}}

            @else

                {{-- START: Username field (editable) --}}

                    <div class="form-field">

                        <label class="flex justify-between mb-1 text-sm font-medium">
                            Username
                        </label>

                        <input
                            type="text"
                            wire:model="form.username"
                            placeholder="Username"
                            class="w-full rounded-lg border border-gray-300 px-4 py-3"
                        />

                    </div>

                {{-- END: Username field (editable) --}}

            @endif
            

            <div class="form-field">
                <label class="flex justify-between mb-1 text-sm font-medium">
                    Email
                </label>

                <input
                    type="email"
                    wire:model="form.newEmail"
                    class="w-full rounded-lg border border-gray-300 px-4 py-3"
                    placeholder="Email"
                >

                @error('form.newEmail')
                    <div class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-field">
                <label class="flex justify-between items-center mb-1 text-sm font-medium">
                    First name
                    <span class="text-gray-400 text-xs font-light mr-2!">(optional)</span>
                </label>

                <input
                    type="text"
                    wire:model="form.first_name"
                    class="w-full rounded-lg border border-gray-300 px-4 py-3"
                    placeholder="First name"
                >

                @error('form.first_name')
                    <div class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </div>
                @enderror

            </div>

            <div class="form-field">
                <label class="flex justify-between items-center mb-1 text-sm font-medium">
                    Last name
                    <span class="text-gray-400 text-xs font-light mr-2!">(optional)</span>
                </label>

                <input
                    type="text"
                    wire:model="form.last_name"
                    class="w-full rounded-lg border border-gray-300 px-4 py-3"
                    placeholder="Last name"
                >

                @error('form.last_name')
                    <div class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </div>
                @enderror

            </div>

            <div class="form-field">

                <label class="flex justify-between items-center mb-1 text-sm font-medium">
                    Country
                    <span class="text-gray-400 text-xs font-light mr-2!">(optional)</span>
                </label>

                <select
                    wire:model="form.country_code"
                    class="w-full rounded-lg border px-4 py-3
                    {{ $country_code ? '' : 'text-stone-400' }}"
                >
                    <option value="">
                        Select country
                    </option>

                    @foreach ($countries as $code => $name)
                        <option value="{{ $code }}">
                            {{ $name }}
                        </option>
                    @endforeach
                </select>

                @error('form.country_code')
                    <div class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </div>
                @enderror

            </div>

            @if($country_code === 'US')
                <div class="form-field">
                    <label class="flex justify-between mb-1 text-sm font-medium">
                        State
                        <span class="text-gray-400 text-xs font-light">(optional)</span>
                    </label>

                    <select wire:model="form.state_code" class="w-full rounded-lg border px-4 py-3">
                        <option value="">Select a state</option>

                        @foreach ($states as $code => $name)
                            <option value="{{ $code }}">
                                {{ $name }}
                            </option>
                        @endforeach
                    </select>
                </div>
      
            @endif
            

            {{-- Email --}}
            
            <div class="form-buttons">
                <button
                    type="submit"
                    class="btn"
                >
                    Save Changes
                </button>
            </div>

        </form>

    </x-cards.form>

</div>