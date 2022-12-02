<div class="movie-wrapper">
    <div class="movie-poster">
        @if(file_exists(public_path().'/files/img/torrent-cover_'.$torrent->id.'.jpg'))
            <img src="{{ url('files/img/torrent-cover_' . $torrent->id . '.jpg') }}" class="img-responsive"
                 id="meta-poster">
        @else
            <img src="/img/SLOshare/meta_no_image_holder_400x600.jpg" class="img-responsive" id="meta-poster">
        @endif
    </div>
    <div class="meta-info">
        {{-- General Info Block --}}
        @include('torrent.partials.no_meta_general')
        <div class="torrent-buttons">
            @include('torrent.partials.buttons')
        </div>
    </div>
</div>
</div>