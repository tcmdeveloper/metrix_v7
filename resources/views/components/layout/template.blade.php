<!DOCTYPE html>
<html lang="en">

    <head>

        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-41956QHQLE"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-41956QHQLE');
        </script>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="icon" type="image/png" href="{{asset('images/favicon-94x94.png')}}">

        @meta_tags
        
        {{-- Google Fonts --}}
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,400;0,600;0,700;1,300;1,400;1,600&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700&family=Roboto+Slab:wght@100;200;300;400;500;600;700;800;900&family=Roboto:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet" media="print" onload="this.onload=null;this.removeAttribute('media');">

        <link href="https://fonts.cdnfonts.com/css/lemon-milk" rel="stylesheet">


        {{-- @if(environmentIsProduction())
            @foreach(explodeCssAssets() as $cssAsset)
                <link href="{{ asset('build/assets/'.trim($cssAsset))}}"  rel="preload" as="style" onload="this.rel='stylesheet'">
            @endforeach
            @foreach(explodeJsAssets() as $jsAsset)
                <script src="{{ asset('build/assets/'.trim($jsAsset)) }}" defer></script>
            @endforeach
        @else
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif --}}

        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>

    <body>

        <x-layout.navigation />

        <main>
            <x-layout.container class="{{isset($containerClass) ? $containerClass : null}}">

                <div>
                    {{-- @if(empty($breadcrumbs) === false)
                        <x-elements.breadcrumbs :breadcrumbs="$breadcrumbs" />
                    @endif --}}

                    @if(empty($pageHeadings) === false)
                        <x-cards.page-headings :pageHeadings="$pageHeadings" />
                    @endif

                    {{$slot}}

                </div>

            </x-layout.container>

        </main>

        <x-layout.footer />

        <x-blackout />

    </body>

</html>