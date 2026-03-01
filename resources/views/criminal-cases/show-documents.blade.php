<x-layout.template :page-headings="$pageHeadings" :breadcrumbs="$breadcrumbs">



    {{-- SET OG:IMAGE FOR SHARING THIS PAGE --}}

    <script>
        window.addEventListener('load', function(){
            let metaImage = '{{$criminal_case->fetchImage()}}';
            document.querySelector('#ogImage')setAttribute('content', metaImage);
        });
    </script>



    {{-- ADMIN BUTTONS --}}

    <x-elements.admin-buttons-block-criminal-case :criminal_case="$criminal_case" />



    {{-- CONTENT LAYOUT --}}

    <section class="content-layout">


        {{-- IMAGE --}}

        <x-elements.content-show-image :resource="$criminal_case" />


        {{-- TEXT --}}

        <div>

            {{-- {!!$criminal_case->description!!} --}}
            
        </div>


        <ul class="grid grid-cols-1 justify-center">

            @foreach($criminal_case->documents as $document)

                <li class="justify-self-center text-xl">

                    <a
                        href="/criminal-cases/{{$criminal_case->slug . $document->link()}}"
                    >
                        {{$document->title}}
                    </a>
                
                </li>

            @endforeach

        </ul>


    </section>


</x-layout.template>