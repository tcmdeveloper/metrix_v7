@if($resource->category)

        <a
            href="{{$resource->category->link()}}"
            {{$attributes->merge(['class' => 'category-pip bg-'.$resource->category->color])}}
        >

            {{$resource->category->name}}
        </a>

@endif