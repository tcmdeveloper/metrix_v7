@props([
    'message' => null,
    'type' => null,
])

@php

    $status = session('status');

    $type =
        $type
        ?? $status['type'] ?? null
        ?? (session('success') ? 'success' : null)
        ?? (session('warning') ? 'warning' : null)
        ?? (session('error') ? 'error' : null)
        ?? ($errors->any() ? 'error' : null);

    $message =
        $message
        ?? $status['message'] ?? null
        ?? session('success')
        ?? session('warning')
        ?? session('error')
        ?? $errors->first();

@endphp


@if ($message)

    <div
        wire:key="alert-{{ md5($message . $type) }}"
        x-data="{ show: true }"
        x-init="
            $nextTick(() => {
                show = true;
                setTimeout(() => show = false, 4000);
            })
        "
        x-show="show"
        x-transition
        class="alert alert-{{ $type }}"
    >

        <div class="flex items-center justify-between gap-4">

            <div class="flex items-center gap-3">

                <span>{{ $message }}</span>

            </div>

        </div>

    </div>

@endif