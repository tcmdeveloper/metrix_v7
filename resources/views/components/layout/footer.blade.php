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
                    <x-icon.brand name="youtube" class="w-4 h-4" />
                </a>
                <a 
                    href="{{config('discord_url')}}"
                    target="_blank"
                    aria-label="Join True Crime Metrix on Discord"
                    >
                    <x-icon.brand name="discord" class="w-4 h-4" />
                </a>
                <a 
                    href="{{config('instagram_url')}}" 
                    target="_blank" 
                    aria-label="Follow True Crime Metrix on Instagram"
                    >
                    <x-icon.brand name="instagram" class="w-4 h-4" />
                </a>
                <a 
                    href="{{config('twitter_url')}}"
                    target="_blank"
                    aria-label="Follow True Crime Metrix on X"
                    >
                    <x-icon.brand name="x" class="w-4 h-4" />
                </a>

            </li>

            <li class="socials">
                <span>
                    Support links
                </span>
                <a 
                    href="http://paypal.me/truecrimemetrix"
                    target="_blank"
                    aria-label="Support us on PayPal"
                    >
                    <x-icon.brand name="buymeacoffee" class="w-4 h-4" />
                </a>
                <a 
                    href="http://buymeacoffee.com/truecrimemetrix"
                    target="_blank"
                    aria-label="Buy me a coffee"
                    >
                    <x-icon.brand name="buymeacoffee" class="w-4 h-4" />
                </a>
                <a 
                    href="https://www.patreon.com/truecrimemetrix_official"
                    target="_blank"
                    aria-label="Follow True Crime Metrix on Twitter"
                    >
                    <x-icon.brand name="patreon" class="w-4 h-4" />
                </a>
                <a 
                    href="https://www.bonfire.com/store/true-crime-metrix/"
                    target="_blank"
                    aria-label="Buy me a coffee"
                    >
                    <x-heroicon-o-shopping-cart class="w-5 h-5 stroke-2" />
                </a>
            </li>

            <li class="copyright">
                Copyright © {{date('Y', time())}} {{config('copyright')}}&nbsp;&nbsp;|&nbsp;&nbsp;All rights reserved. 
            </li>
        </ul>
    </x-layout.container>
</footer>