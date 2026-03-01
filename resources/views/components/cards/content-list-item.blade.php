<div {{$attributes->merge(['class' => 'content-list-item'])}} class="text-2xl">


    <a
        href="{{$resource->link()}}"
        aria-label="{{$resource->linkLabel()}}"
        class="text-3xl font-black hover-dip"
    >
    
            {{$resource->title}}
    
    </a>



    {{-- IMAGE THUMBNAIL --}}

    {{-- <div class="image">

        <a
            href="{{$resource->link()}}"
            aria-label="{{$resource->linkLabel()}}"
        >

            <img
                src="{{$resource->fetchImage(true, 'tn')}}"
                alt="{{config('app.name').' - '.$resource->title}}"
            >

        </a>

    
    </div> --}}




    {{--TEXT --}}

    {{-- <div class="text"> --}}


        {{-- CATEGORY PIP --}}

        {{-- @unless(isset($hidePip) && $hidePip === true)
            @if(isset($listSize) && $listSize === 'sm')

                <x-elements.category-pip :resource="$resource->criminal_case" class="category-pip-sm" />

            @else
                
                <x-elements.category-pip :resource="$resource->criminal_case" />

            @endif
        @endunless --}}


        {{-- TITLE --}}

        {{-- <a
            href="{{$resource->link()}}"
            aria-label="{{$resource->linkLabel()}}"
            class="title"
        >
            {{$resource->title}}
        </a> --}}


        {{-- @unless(isset($listSize) && $listSize === 'sm') --}}

            {{-- RESOURCE PUBLISHING INFORMATION --}}

            {{-- <x-elements.resource-publishing-information :resource="$resource" class="text-xl" />

        @endunless


    </div> --}}


</div>