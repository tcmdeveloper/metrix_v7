<x-layout.template :pageHeadings="$pageHeadings" container-class="container-sm">
    
    @if(count($criminal_cases) > 0)

        <x-blocks.flex-list-of-resources heading="Criminal cases" :resources="$criminal_cases" />

        {{-- PAGINATION --}}

        {{ $criminal_cases->links() }}
        
    @endif




    @if(count($articles) > 0)

        <x-blocks.flex-list-of-resources heading="News articles" :resources="$articles" class="bg-red-400" />

        {{-- PAGINATION --}}

        {{ $articles->links() }}
        
    @endif




    @if(count($criminals) > 0)

        <x-blocks.flex-list-of-resources heading="Criminals" :resources="$criminals" />

        {{-- PAGINATION --}}

        {{ $criminals->links() }}
        
    @endif

</x-layout.template>
