<div {{$attributes->merge(['class' => 'grid-4-cols'])}}>
    
    @foreach($resources as $resource)

        <x-cards.content-image-text-overlay :resource="$resource" />

    @endforeach

</div>