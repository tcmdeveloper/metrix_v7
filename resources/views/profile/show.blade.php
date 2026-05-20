<x-layout.template :page-headings="$pageHeadings">
    
   <div class="card profile-card">


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



        {{-- Details list --}}

        <ul class="details-list">


            {{-- Name --}}

            <li>
                <span class="font-medium">Your name</span>
                <span>
                    @if($user->full_name)
                        <span>{{ $user->full_name }}</span>
                    @else
                        <a href="{{ route('profile.edit') }}" class="flex items-center justify-center w-36
                            bg-gray-100 border border-gray-300
                            !px-4 !py-1
                            text-xs font-normal text-gray-800
                            rounded-sm shadow-sm
                            transition-all duration-150 ease-in-out
                            hover:bg-gray-200 hover:-translate-y-[1px] hover:shadow
                            active:translate-y-0 active:shadow-sm
                            focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2"
                        >Add your name</a>
                    @endif
                </span>
            </li>




            {{-- Country --}}

            <li>
                <span class="font-medium">Country</span>
                <span>
                    @if($user->country_name)
                        <span>{{ $user->country_name }}</span>
                    @else
                        <a href="{{ route('profile.edit') }}" class="flex items-center justify-center w-36
                            bg-gray-100 border border-gray-300
                            !px-4 !py-1
                            text-xs font-normal text-gray-800
                            rounded-sm shadow-sm
                            transition-all duration-150 ease-in-out
                            hover:bg-gray-200 hover:-translate-y-[1px] hover:shadow
                            active:translate-y-0 active:shadow-sm
                            focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2"
                        >Add country</a>
                    @endif
                </span>
            </li>




            {{-- State --}}

            @if ($user->country_code === 'US')

                <li>
                    <span class="font-medium">State</span>
                    <span>{{ $user->state_name }}</span>
                </li>
            
            @endif



            {{-- Email --}}

            <li>
                <span class="font-medium">Email</span>
                <span>
                    @if($editing === 'newEmail')
                        <input wire:model="form.newEmail">

                        <button wire:click="saveName">Save</button>
                        <button wire:click="$set('editing', null)">Cancel</button>
                    @else
                        <p>{{ $user->name }}</p>

                        <button wire:click="$set('editing', 'newEmail')">
                            Edit
                        </button>
                    @endif
                </span>
            </li>




            {{-- Username --}}

            <li>
                <span class="font-medium">Username</span>
                <span>
                    @if($user->username)
                        <span>{{ $user->username }}</span>
                    @else
                        <a href="{{ route('profile.edit') }}" class="flex items-center justify-center w-36
                            bg-gray-100 border border-gray-300
                            !px-4 !py-1
                            text-xs font-normal text-gray-800
                            rounded-sm shadow-sm
                            transition-all duration-150 ease-in-out
                            hover:bg-gray-200 hover:-translate-y-[1px] hover:shadow
                            active:translate-y-0 active:shadow-sm
                            focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2"
                        >Choose username</a>
                    @endif
                </span>
            </li>




            {{-- Password --}}

            <li>
                <span class="font-medium">Password</span>
                <span>••••••••</span>
            </li>

        
        </ul>
    






        {{-- Form buttons --}}
        <div class="mt-10! flex gap-3">

            <a
                href="/profile/edit"
                class="btn"
            >
                Edit Profile
            </a>

            <a
                href="/profile/password"
                class="btn"
            >
                Change Password
            </a>

        </div>













</x-layout.template>