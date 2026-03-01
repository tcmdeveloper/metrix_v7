<x-layout.template :page-headings="$pageHeadings" :breadcrumbs="$breadcrumbs">

    
    {{-- GRID --}}

    <div class="grid-1-cols">


        @foreach($criminal_cases as $criminal_case)


            {{-- CONTENT LIST ITEM --}}

            <x-cards.content-list-item :resource="$criminal_case" class="content-list-item-vertical" />

        @endforeach

    </div>

</x-layout.template>