@props(['name', 'color' => 'FFFFFF', 'size' => 20])

@php
    $url = "https://cdn.simpleicons.org/{$name}/{$color}";
@endphp

<img
    src="{{ $url }}"
    width="{{ $size }}"
    height="{{ $size }}"
    alt="{{ $name }}"
    {{ $attributes }}
/>