@props(['breadcrumbs'])

@auth
    <div class="h-[58px]"></div>
@endauth

<div {{$attributes->merge(['class' => 'breadcrumbs'])}}>

    <ul>

        @foreach ($breadcrumbs as $i => $breadcrumb)

            <li>

                <a
                    href="{{$breadcrumb['link']}}"
                    class="{{$loop->last === true ? 'font-bold underline' : 'no-underline hover:underline'}}"
                >
                    {{$breadcrumb['label']}}
                </a>

            </li>

            @if($loop->last === false)

                <li>
                    <i class="fa-solid fa-chevron-right"></i>
                </li>

            @endif

        @endforeach

    </ul>

</div>