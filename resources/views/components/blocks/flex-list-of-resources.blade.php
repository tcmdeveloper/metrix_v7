{{-- LIST HEADING --}}

@if(isset($listSize) && $listSize === 'sm')

    <x-cards.list-heading :heading="$heading" class="list-heading-sm" />

@else
                
    <x-cards.list-heading :heading="$heading" />

@endif


{{-- LIST OF RESOURCES --}}

<ul class="{{(isset($listSize) && $listSize === 'sm') ? 'resources-list-sm' : 'resources-list'}}">


    @foreach ($resources as $resource)


        <li>

            @if(isset($listSize) && $listSize === 'sm')

                <x-cards.content-list-item :resource="$resource" :list-size="$listSize" class="content-list-item-sm" />
             
            @else
                
                <x-cards.content-list-item :resource="$resource" />

            @endif

        </li>


    @endforeach


</ul>
