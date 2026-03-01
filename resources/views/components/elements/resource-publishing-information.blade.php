<ul {{$attributes->merge(['class' => 'resource-publishing-information'])}}>

    <li>
        <i class="fa-solid fa-user mr-1"></i>
        {{$resource->user->shortName()}}
    </li>

    <li>
        <i class="separator"></i>
    </li>

    <li>
        <i class="fa-regular fa-clock mr-1"></i>
        {{showDateTime($resource->created_at, false, 'short')}}
    </li>

    <li>
        <i class="separator"></i>
    </li>

    <li>
        <i class="fa-regular fa-eye mr-1"></i>
        {{formatViews($resource->views)}}
    </li>

</ul>