<div class="row">
    <div class="col-sm-8 col-md-8" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
        <meta itemprop="ratingValue" content="{{ $rating_avg }}">
        <meta itemprop="ratingCount" content="{{ $rating_count }}">
        <meta itemprop="bestRating" content="5">
        <meta itemprop="worstRating" content="1">
        @include('theme::layouts.partials.rating.item',['label'=>'','rating_avg'=>$rating_avg,'rating_count'=>$rating_count])
        {{-- item_type_schema_org  e microdate_schema_org son mutators non campi --}}
        {{--
            <div itemprop="itemReviewed" itemscope itemtype="{{ $row->item_type_schema_org }}" >
                <meta itemprop="url" content="{{ $row_panel->url() }} " >
                <meta itemprop="name" content="{{ $row->title }} " >
                {!! $row_panel->microdataSchemaOrg() !!}

            </div>
            --}}

    </div>
    <div class="col-sm-4 col-md-4">
        <a href="{{ $rating_url }}">
            <button class="btn btn-danger btn-red"  data-title="vota {{ $title }}" >
                <span class="font-white"><i class="fa fa-star"></i> Vota !</span>
            </button>
        </a>
    </div>
    </div>
