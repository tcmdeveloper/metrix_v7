<footer>
    <x-layout.container>
        <ul class="stack">
            <li>
                <a href="/" aria-label="View {{config('app.name')}} homepage">
                    {{config('app.name')}}
                </a>
            </li>
            <li>
                <ul class="menu">
                    {{-- <li>
                        <a href="/about" aria-label="Learn more about {{config('app.name')}}">
                            About
                        </a>
                    </li> --}}
                    <li>
                        <a href="/contact" aria-label="Contact us at {{config('app.name')}}">
                            Contact
                        </a>
                    </li>
                    {{-- <li>
                        <a href="/opportunities" aria-label="View the opportunities at {{config('app.name')}}">
                            Opportunities
                        </a>
                    </li> --}}
                    <li>
                        <a href="/privacy-policy"  aria-label="View our privacy policy">
                            Privacy policy
                        </a>
                    </li>
                    <li>
                        <a href="/terms-of-service" aria-label="View ur terms of service">
                            Terms of service
                        </a>
                    </li>
                </ul>
            </li>
            <li class="socials">
                <span>
                    Stay connected
                </span>
                
                <a 
                    href="{{config('youtube_url')}}"
                    target="_blank"
                    aria-label="Subscribe to True Crime Metrix on YouTube"
                    >
                    <i class="fa-brands fa-youtube"></i>
                </a>
                <a 
                    href="{{config('discord_url')}}"
                    target="_blank"
                    aria-label="Join True Crime Metrix on Discord"
                    >
                    <i class="fa-brands fa-discord"></i>
                </a>
                <a 
                    href="{{config('instagram_url')}}" 
                    target="_blank" 
                    aria-label="Follow True Crime Metrix on Instagram"
                    >
                    <i class="fa-brands fa-instagram"></i>
                </a>
                <a 
                    href="{{config('twitter_url')}}"
                    target="_blank"
                    aria-label="Follow True Crime Metrix on Twitter"
                    >
                    <i class="fa-brands fa-twitter"></i>
                </a>
                <a 
                    href="{{config('facebook_url')}}"
                    target="_blank" 
                    aria-label="Follow True Crime Metrix on Facebook"
                    >
                    <i class="fa-brands fa-facebook-f"></i>
                </a>
                
                
                
            </li>
            <li class="copyright">
                Copyright © {{date('Y', time())}} {{config('copyright')}}&nbsp;&nbsp;|&nbsp;&nbsp;All rights reserved. 
            </li>
        </ul>
    </x-layout.container>
</footer>