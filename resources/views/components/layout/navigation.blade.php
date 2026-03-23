<nav id="navBar">

    <x-layout.container>

        <ul>

            {{-- LEFT COLUMN --}}

            <li>
                <a
                    id="openSlideMenuIcon"
                    href="#"
                    aria-label="Open main menu"
                    class="hover:translate-y-1"
                >
                    <i class="fa-solid fa-bars"></i>
                </a>
            </li>

            
            {{-- CENTER COLUMN --}}

            <li>

                <a 
                    id="siteLogo"
                    href="/"
                    aria-label="Go to True Crime Metrix homepage"
                    class="text-xl! md:text-2xl!"
                >   
                    <img src="{{asset('images/favicon-94x94.png')}}" class="inline-block w-[42px]">
                    {{config('app.name')}}

                </a>
            </li>


            {{-- RIGHT COLUMN --}}

            <li
                class="flex gap-6 justify-end"
            >
                @auth
                    <a
                        href="/dashboard"
                        aria-label="Go to dashboard"
                        class="hover:translate-y-1"
                    >
                        <i class="fa-solid fa-dashboard"></i>    
                @endauth

                <a
                    id="toggleNavSearchIcon"
                    href="#"
                    aria-label="Search content on True Crime Metrix"
                    class="hover:translate-y-1"
                >
                    <i class="fa-solid fa-search"></i>
                </a>

            </li>

        </ul>

    </x-layout.container>

</nav>


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

        {{-- <li>
            <a 
                href="/categories" 
                aria-label="View list of true crime categories"
            >
                Categories
            </a>
        </li> --}}

        <li>
            <a 
                id="slideMenuFirstItem"
                href="/criminal-cases" 
                aria-label="View list of true crime criminal cases"
            >
                Criminal Cases
            </a>
        </li>

        {{-- <li>
            <a
                href="/articles"
                aria-label="View list of true crime news articles"
            >
                Articles
            </a>
        </li> --}}

        {{-- <li>
            <a
                href="/criminals"
                aria-label="View list of criminal profiles"
            >
                Criminals
            </a>
        </li> --}}

        <li>
            <a
                href="/support"
                aria-label="Support True Crime Metrix"
            >
                Support us
            </a>
        </li>

        {{-- <li>
            <a
                href="/judges"
                aria-label="View list of judges"
            >
                Judges
            </a>
        </li> --}}

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
                    href="/dashboard" 
                    aria-label="Go to the dashboard to manage your content"
                >
                    Dashboard
                </a>
            </li>

            <li>
                <form 
                    action="/logout" 
                    method="post"
                >
                    @csrf
                    <a 
                        id="slideMenuLastItem"
                        href="#" 
                        onclick="this.parentNode.submit()"
                    >
                        Log out
                    </a>
                </form>
            </li>
            

        {{-- NAV FOR GUEST USER --}}

        @else

            <li>
                <a  
                    id="slideMenuLastItem"
                    href="/login" 
                    aria-label="Log to manage your content"
                >
                    Login
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
