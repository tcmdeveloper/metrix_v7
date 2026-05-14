<x-layout.template :page-headings="$pageHeadings">

    @if($isConnected)
        <p class="text-green-500 font-bold text-center">
            YouTube API is connected.
        </p>
    @else
        <p class="text-red-500 font-bold text-center">
            YouTube API is not connected.
        </p>
    @endif

</x-layout.template>