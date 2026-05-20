{{-- resources/views/errors/403.blade.php --}}

<x-layout.template :page-headings="['Page not found', 'You don’t have permission to access this page.']">
    <div class="flex justify-center">
        <a href="{{ route('home') }}" class="btn inline-flex w-fit! whitespace-nowrap">Go to homepage</a>
    </div>
</x-layout.template>