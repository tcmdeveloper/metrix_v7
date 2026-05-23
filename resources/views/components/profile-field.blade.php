@props([
    'label',
])

<div class="dt-item">

    {{-- Label --}}
    <dt class="w-[30%]">

        <span class="text-sm font-semibold tracking-wide text-gray-500 uppercase">
            {{ $label }}
        </span>

    </dt>

    {{-- Content --}}
    <dd class="flex-1 text-right">

        {{ $slot }}

    </dd>

</div>