<x-layout.template :page-headings="$pageHeadings" :breadcrumbs="$breadcrumbs">

    @if($document->images->isEmpty())
        <x-elements.alert alert="This document is not available right now." type="success" />
        
    @else

        <div class="grid grid-cols-1 gap-12">
            @foreach($document->images as $image)
                <div class="justify-self-center">
                    <img src="{{asset('/documents/' . $criminal_case->hex . '/' . $document->hex . '/pages/' . $image->filename)}}" alt="" class="">
                </div>

            @endforeach
        </div>
    @endif

</x-layout.template>


 
