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

        <ul class="grid grid-cols-1 justify-center">

            <li class="justify-self-center">

                <a 
                    href="{{$criminal_case->link('documents')}}"
                >
                    <button class="btn btn-xl">Documents</button>
                </a>

            </li>
            {{-- {!!$criminal_case->description!!} --}}

        </ul>


    </section>


</x-layout.template>