<div class="panel panel-chat shoutbox torrent-extra-meta"
     x-data="{ tab: window.location.hash ? window.location.hash.substring(1) : 'recommendations' }" id="tab_wrapper">
    <!-- The tabs navigation -->
    <div class="panel-heading">
        <h4>
            <nav>
                <i class="{{ config("other.font-awesome") }} fa-waveform-path"></i>
                <a :class="{ 'active': 'recommendations' === tab }"
                   @click.prevent="tab = 'recommendations'; window.location.hash = 'recommendations'" href="#">{{ __('torrent.sloshare-recommends') }}</a>
                |
            @if($torrent->category->movie_meta)
                <a :class="{ 'active': 'movie_collection' === tab }"
                   @click.prevent="tab = 'movie_collection'; window.location.hash = 'movie_collection'" href="#">{{ __('torrent.collection-of-movies') }}</a> |
            @endif
            @if($torrent->category->cartoon_meta)
                <a :class="{ 'active': 'cartoon_collection' === tab }"
                   @click.prevent="tab = 'cartoon_collection'; window.location.hash = 'cartoon_collection'" href="#">{{ __('torrent.collection-of-cartoons') }}</a> |
            @endif
            @if($torrent->category->tv_meta)
                <a :class="{ 'active': 'tv_collection' === tab }"
                   @click.prevent="tab = 'tv_collection'; window.location.hash = 'tve_collection'" href="#">{{ __('torrent.collection-of-tv') }}</a> |
            @endif
                <a :class="{ 'active': 'playlists' === tab }"
                   @click.prevent="tab = 'playlists'; window.location.hash = 'playlists'" href="#">{{ __('torrent.playlists') }}</a>
            </nav>
        </h4>
    </div>

    <!-- The tabs content -->
    <div x-show="tab === 'recommendations'">
        @include('torrent.partials.recommendations')
    </div>
    <div x-show="tab === 'movie_collection'">
        @include('torrent.partials.movie_collection')
    </div>
    <div x-show="tab === 'cartoon_collection'">
        @include('torrent.partials.cartoon_collection')
    </div>
    <div x-show="tab === 'tv_collection'">
        @include('torrent.partials.tv_collection')
    </div>
    <div x-show="tab === 'playlists'">
        @include('torrent.partials.playlists')
    </div>
</div>