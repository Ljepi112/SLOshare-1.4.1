<div>
    <div>
        <div class="mb-10">
            <input type="text" wire:model="search" class="form-control" placeholder="{{ __('torrent.search-by-name') }}"/>
        </div>

        @foreach($cartoons as $cartoon)
            <div class="col-md-12">
                <div class="card is-torrent" style=" height: 265px;">
                    <div class="card_head">
                        @if ($cartoon->companies)
                            @foreach ($cartoon->companies as $company)
                                <span class="badge-user text-bold" style="float:right;">
									{{ $company->name }}
								</span>
                            @endforeach
                        @endif
                    </div>
                    <div class="card_body">
                        <div class="body_poster">
                            <img src="{{ isset($cartoon->poster) ? tmdb_image('poster_mid', $cartoon->poster) : '/img/SLOshare/movie_no_image_search.jpg' }}"
                                 class="show-poster">
                        </div>
                        <div class="body_description">
                            <h3 class="description_title">
                                <a href="{{ route('mediahub.cartoons.show', ['id' => $cartoon->id]) }}">{{ $cartoon->title }}
                                    @if($cartoon->release_date)
                                        <span class="text-bold text-pink"> {{ $cartoon->release_date }}</span>
                                    @endif
                                </a>
                            </h3>
                            @if ($cartoon->genres)
                                @foreach ($cartoon->genres as $genre)
                                    <span class="genre-label">{{ $genre->name }}</span>
                                @endforeach
                            @endif
                            <p class="description_plot">
                                {{ $cartoon->overview }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <br>
        <div class="text-center">
            {{ $cartoons->links() }}
        </div>
    </div>
</div>
