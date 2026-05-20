<nav id="navBar">

    <x-layout.container class="container-lg">

        <ul>

            {{-- LEFT COLUMN --}}

            <li class="flex gap-4 md:gap-10 justify-start! items-center">
                <a
                    id="openSlideMenuIcon"
                    href="#"
                    aria-label="Open main menu"
                    class="hover:translate-y-1"
                >
                    <x-heroicon-o-bars-3 class="w-8 aspect-square stroke-2" />
                </a>
            </li>

            
            {{-- CENTER COLUMN --}}

            <li>

                <a 
                    id="siteLogo"
                    href="/"
                    aria-label="Go to True Crime Metrix homepage"
                    class="text-xl! md:text-2xl! text-gray-200!"
                >   
                    {{config('app.name')}}

                </a>
            </li>


            {{-- RIGHT COLUMN --}}

            

            <li
                class="flex gap-2 md:gap-6 justify-end! md:justify-center! items-center"
            >
                @auth
                    <a
                        href="/profile"
                        aria-label="Your profile"
                        class="hover:translate-y-1 text-stone-500"
                    >
                        <div class="flex items-center align-center gap-3 h-7 ">
                            
                            <span class="font-normal text-xs whitespace-nowrap tracking-widest hidden! md:block!">
                                {{ Auth::user()->userHandle }}
                            </span>

                            <img
                                src="{{ Auth::user()->avatar_url }}"
                                alt="Profile"
                                class="w-7! aspect-square rounded-full object-cover"
                            >

                        </div>
                    </a>
                @endauth

                <a
                    id="toggleNavSearchIcon"
                    href="#"
                    aria-label="Search content on True Crime Metrix"
                    class="hover:translate-y-1"
                >
                    <x-heroicon-o-magnifying-glass class="w-8 aspect-square stroke-2" />
                </a>

            </li>

        </ul>

    </x-layout.container>

</nav>


@auth
    @if (!auth()->user()->hasVerifiedEmail())

            
                @if (session('status') == 'verification-link-sent')

                    <div class="fixed w-screen bg-green-50 text-green-900 top-[85px]! py-2! text-sm border-b border-gray-200 font-normal shadow-xs">
                        <x-layout.container class="container-lg flex justify-center">
                            <span class="flex gap-1">
                                <x-heroicon-s-check class="w-5 h-5 stroke-1" /> <b>Sent!</b> Check your email to confirm your account.
                            </span>
                        </x-layout.container>
                    </div>
                    
                @else
                    
                    <div class="fixed w-screen top-[85px]! py-2! text-sm border-b bg-yellow-50 border-gray-200 text-yellow-900 font-normal shadow-xs">
                        <x-layout.container class="container-lg flex justify-center">
                            <span class="flex gap-1">
                                <x-heroicon-s-bell-alert class="w-5 h-5 stroke-1" /> Please verify your email address
                            </span>
                            <span class="!mx-1">-</span>

                            <form method="POST" action="{{ route('verification.send') }}">
                                @csrf

                                <button class="underline hover:no-underline cursor-pointer flex gap-1">
                                    Resend verification email
                                </button>
                            </form>
                        </x-layout.container>
                    </div>
                    
                @endif
        
            @endif
    
@endauth

{{-- SLIDE MENU --}}

<nav id="slideMenu" class="-left-full">

    <a 
        id="closeSlideMenuIcon"
        href="#"
        aria-label="Click to close slide menu"
    >
        <i class="fa-solid fa-times"></i>
    </a>


    <ul class="hidden">

        <li>
            <a 
                id="slideMenuFirstItem"
                href="/" 
                aria-label="True Crime Metrix homepage"
            >
                Home
            </a>
        </li>

        <li>
            <a 
                href="/criminal-cases" 
                aria-label="View list of true crime criminal cases"
            >
                Criminal Cases
            </a>
        </li>

        <li>
            <a
                href="/contact"
                aria-label="Go to contact us page"
            >
                Contact
            </a>
        </li>


        {{-- NAV FOR AUTH USER --}}

        @auth

            <li>
                <a
                    href="/profile" 
                    aria-label="Go to your profile"
                >
                    Profile
                </a>
            </li>

            <li>
                <form 
                    action="{{ route('logout') }}"
                    x-ref="logout" 
                    method="POST" 
                    
                >
                    @csrf
                    <button @click.prevent="$refs.logout.submit()">
                        Logout
                    </button>
                </form>
            </li>
            

        {{-- NAV FOR GUEST USER --}}

        @else

            <li>
                <a  
                    id="slideMenuLastItem"
                    href="{{ route('login') }}" 
                    aria-label="Log to manage your content"
                >
                    Login
                </a>
            </li>

            <li>
                <a  
                    id="slideMenuLastItem"
                    href="{{ route('register') }}" 
                    aria-label="Create account"
                >
                    Create account
                </a>
            </li>

        @endauth

    </ul>

</nav>




{{-- SEARCH BAR --}}


<section 
    id="navSearchBar" 
    class="-translate-y-20"
>

    <form 
        id="navSearchForm"
        action="/grab-search-term" 
        method="POST"
    >

        @csrf
        @method('POST')

        <input
            id="navSearchInput"
            type="text"
            name="search_term"
            placeholder="Search metrix"
        >

    </form>

</section>
