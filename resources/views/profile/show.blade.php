<div>

    <x-cards.form class="profile-card">
        

        {{-- Header --}}

        <div class="header">
            
            <img
                src="{{ Auth::user()->avatar_url }}"
                alt="Profile"
                class="w-20 h-20 rounded-full object-cover"
            >

            <div class="pr-20">
                <h1 class="text-2xl font-bold">
                    {{ $user->userHandle }}
                </h1>
            </div>

        </div>
        

        {{-- Form --}}

        <form wire:submit.prevent="save">


            {{-- Detailed list --}}

            <dl class="divide-y divide-gray-100 rounded-xs border border-stone-100 shadow-sm bg-white mt-6!">


                {{-- Your name --}}

                <x-profile-field label="Your name">

                    @if($editing)
                        
                        <div class="flex gap-3">
                            <input
                                type="text"
                                wire:model.defer="form.first_name"
                                placeholder="First name"
                                @class([
                                    'input',
                                    'input-sm',
                                    'input-error' => $errors->has('first_name')
                                ])
                            />

                            <input
                                type="text"
                                wire:model.defer="form.last_name"
                                placeholder="Last name"
                                @class([
                                    'input',
                                    'input-sm',
                                    'input-error' => $errors->has('last_name')
                                ])
                            />
                        </div>

                    @else
                        @if($user->full_name)
                            <span>
                                {{ $user->full_name }}
                            </span>
                        @else
                            <button
                                type="button"
                                wire:click="edit"
                                class="btn btn-primary btn-sm"
                            >
                                Add name
                            </button>
                        @endif
                    @endif

                </x-profile-field>



                {{-- Username --}}

                <x-profile-field label="Username">

                    
                    @if($editing)
                    
                        <input
                            type="text"
                            wire:model.defer="form.username"
                            placeholder="Username"
                            @class([
                                'input',
                                'input-sm',
                                'input-error' => $errors->has('username')
                            ])
                            @disabled(Auth::user()->username)
                        />
        

                    @else
                        @if($user->username)
                            <span>
                                {{ $user->username }}
                            </span>
                        @else
                            <button
                                type="button"
                                wire:click="edit"
                                class="btn btn-primary btn-sm"
                            >
                                Add username
                            </button>
                        @endif
                    @endif
                   

                </x-profile-field>



                {{-- Email --}}

                <x-profile-field label="Email">

                    @if($editing)
                            
                        <input
                            type="text"
                            wire:model.defer="form.newEmail"
                            placeholder="Email"
                            @class([
                                'input',
                                'input-sm',
                                'input-error' => $errors->has('email')
                            ])
                        />

                    @else

                        <span>{{ $user->email }}</span>

                    @endif

                </x-profile-field>



                {{-- Country --}}

                <x-profile-field label="Country">

                    @if($editing)
                            
                        <select
                            wire:model.defer="form.country_code"
                            @class([
                                'input',
                                'input-sm',
                                'input-error' => $errors->has('country_code')
                            ])
                        >
                            <option value="">
                                Select country
                            </option>
                            @foreach ($this->countries() as $code => $name)
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

                    @else
                        @if($user->country_code)
                            
                            <span>
                                {{ $this->countries()[$user->country_code] ?? $user->country_code }}
                            </span>
                        @else
                            <button
                                type="button"
                                wire:click="edit"
                                class="btn btn-primary btn-sm"
                            >
                                Add country
                            </button>
                        @endif
                    @endif

                </x-profile-field>




                @if($user->country_code === 'US')
                    <x-profile-field label="State">
                        @if($editing)
                            
                            <select
                                wire:model.defer="form.state_code"
                                @class([
                                    'input',
                                    'input-sm',
                                    'input-error' => $errors->has('state_code')
                                ])
                            >
                                <option value="">
                                    Select state
                                </option>
                                @foreach ($this->states() as $code => $name)
                                    <option value="{{ $code }}">
                                        {{ $name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('form.state_code')
                                <div class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </div>
                            @enderror

                        @else
                            @if($user->state_code)
                            
                                <span>
                                    {{ $this->states()[$user->state_code] ?? $user->state_code }}
                                </span>
                            @else
                                <button
                                    type="button"
                                    wire:click="edit"
                                    class="btn btn-primary btn-sm"
                                >
                                    Add state
                                </button>
                            @endif
                            

                        @endif

                    </x-profile-field>
        
                @endif




                <x-profile-field label="Password">

                    <span>••••••••</span>

                </x-profile-field>

            </dl>


            {{-- Form buttons --}}

            <div class="mt-10! flex gap-3">

                @if($editing)
                    <button type="submit" class="btn btn-success w-full">
                        Save changes
                    </button>

                    <button
                        type="button"
                        wire:click.prevent="cancelEdit"
                        class="btn btn-danger w-full"
                    >
                        Cancel
                    </button>
                @else
                    <button
                        type="button"
                        wire:click="edit"
                        class="btn btn-primary w-full"
                    >
                        Edit profile
                    </button>

                    <button
                        type="button"
                        wire:click="editPassword"
                        class="btn btn-normal w-full"
                    >
                        Change Password
                    </button>
                @endif
            
            </div>


        </form>
    






        
    </x-cards.form>


</div>







