<div class="page-headings-card">
    @unless(empty($pageHeadings[0]))
        <h1>{!!$pageHeadings[0]!!}</h1>
    @endunless
    @unless(empty($pageHeadings[1]))
        <h2>{!!$pageHeadings[1]!!}</h2>
    @endunless
</div>