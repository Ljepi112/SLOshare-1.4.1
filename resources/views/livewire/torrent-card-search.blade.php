<div>
    <div class="container-fluid">
        <style>
            .form-group {
                margin-bottom: 5px !important;
            }

            .badge-extra {
                margin-bottom: 0;
            }
        </style>
        <div x-data="{ open: false }" class="container" id="torrent-list-search"
             style="margin-bottom: 0; padding: 10px 250px; border-radius: 5px;">
                <div class="search-article">
                    <div class="search-center">
                        <input wire:model.debounce.500ms="name" type="search" class="form-control" placeholder="Ime"/>
                    </div>
                </div>
                <div class="search-cat">
                    <button class="button-search-cast-tab" @click="open = ! open"
                            x-text="open ? '{{ __('common.search-hide') }}' : '{{ __('common.search-advanced') }}'"></button>
                </div>

                <!-- PODROBNO ISKANJE -->

                <div class="search-cast-tab">
                <select wire:model="perPage" class="form-control page-search">
			        <option value="25">25</option>
				    <option value="50">50</option>
				    <option value="100">100</option>
			    </select>


                <!-- faza 1 -->
                    <div x-show="open" class="category" id="torrent-advanced-search">
                        <table>
                            <tbody>
                                <tr>
                                <!-- Category -->
                                    <td valign="top" class="category-td">
                                        <fieldset style="border-right:0px;border-left:0px;border-bottom:0px;margin-right:5px;padding-top:10px;width:183px;">
                                            <legend>
                                                <label for="categories">{{ __('common.category') }}</label>
                                            </legend>
                                            <div class="margin-left:2px;">
                                                @php $categories = cache()->remember('categories', 3_600, fn () => App\Models\Category::all()->whereBetween('id', [1, 12])->sortBy('position')) @endphp
                                                @foreach ($categories as $category)
                                                <div class="kategorija">
                                                    <input type="checkbox" wire:model.prefetch="categories" value="{{ $category->id }}"> {{ $category->name }}
								                </div>
                                                @endforeach
                                            </div>
                                        </fieldset>
                                    </td>
                                    <!-- Category -->

                                    <!-- Type -->
                                    <td valign="top" class="category-td">
                                        <fieldset style="border-right:0px;border-left:0px;border-bottom:0px;margin-right:5px;padding-top:10px;width:183px;">
                                            <legend style>
                                                <label for="types">{{ __('common.type') }}</label>
                                            </legend>
                                            <div class="margin-left:2px;">
                                                @php $types = cache()->remember('types', 3_600, fn () => App\Models\Type::all()->sortBy('position')) @endphp
                                                @foreach ($types as $type)
                                                <div class="kategorija">
                                                    <input type="checkbox" wire:model.prefetch="types" value="{{ $type->id }}"> {{ $type->name }}
								                </div>
                                                @endforeach
                                            </div>
                                        </fieldset>
                                    </td>
                                    <!-- Type -->

                                    <!-- Resolution -->
                                    <td valign="top" class="category-td">
                                        <fieldset style="border-right:0px;border-left:0px;border-bottom:0px;margin-right:5px;padding-top:10px;width:183px;">
                                            <legend style>
                                                <label for="resolutions">{{ __('common.resolution') }}</label>
                                            </legend>
                                            <div class="margin-left:2px;">
                                                @php $resolutions = cache()->remember('resolutions', 3_600, fn () => App\Models\Resolution::all()->sortBy('position')) @endphp
                                                @foreach ($resolutions as $resolution)
                                                <div class="kategorija">
                                                    <input type="checkbox" wire:model.prefetch="resolutions" value="{{ $resolution->id }}"> {{ $resolution->name }}
								                </div>
                                                @endforeach
                                            </div>
                                        </fieldset>
                                    </td>
                                    <!-- Resolution -->

                                    <!-- Genre -->
                                    <td valign="top" class="category-td">
                                        <fieldset style="border-right:0px;border-left:0px;border-bottom:0px;margin-right:5px;padding-top:10px;width:183px;">
                                            <legend style>
                                                <label for="genres">{{ __('common.genre') }}</label>
                                            </legend>
                                            <div class="margin-left:2px;">
                                                @foreach (App\Models\Genre::all()->sortBy('name') as $genre)
                                                <div class="kategorija">
                                                    <input type="checkbox" wire:model.prefetch="genres" value="{{ $genre->id }}"> {{ $genre->name }}
								                </div>
                                                @endforeach
                                            </div>
                                        </fieldset>
                                    </td>
                                    <!-- Genre -->

                                </tr>
                            </tbody>
                        </table>
                    </div>
                <!-- faza 1 -->
                </div>
                <!-- PODROBNO ISKANJE -->
        </div>
        <!-- x-data -->
    </div>
    <!-- container-fluid -->
    <br>
    <div class="text-center">
        {{ $torrents->links() }}
    </div>
    <br>
    <div class="table-responsive block">
			<span class="torrent-listings-stats" style="float: right; color:#ffffff;">
				<strong>Št.:</strong> {{ number_format($torrentsStat->total) }} |
				<strong>Živi:</strong> {{ number_format($torrentsStat->alive) }} |
				<strong>Mrtvi:</strong> {{ number_format($torrentsStat->dead) }}
			</span>
			<table table class="table table-condensed table-striped table-bordered">
			</table>
        @foreach($torrents as $torrent)
            @php $meta = null @endphp
            @if ($torrent->category->tv_meta)
                @if ($torrent->tmdb || $torrent->tmdb != 0)
                    @php
                        $meta = cache()->remember('tv.'.$torrent->tmdb, 3_600, function() use ($torrent) {
                            return App\Models\Tv::where('id', '=', $torrent->tmdb)->first();
                        })
                    @endphp
                @endif
            @endif
            @if ($torrent->category->movie_meta)
                @if ($torrent->tmdb || $torrent->tmdb != 0)
                    @php
                        $meta = cache()->remember('movie.'.$torrent->tmdb, 3_600, function() use ($torrent) {
                            return App\Models\Movie::where('id', '=', $torrent->tmdb)->first();
                        })
                    @endphp
                @endif
            @endif
            @if ($torrent->category->cartoon_meta)
                @if ($torrent->tmdb || $torrent->tmdb != 0)
                    @php
                        $meta = cache()->remember('cartoon.'.$torrent->tmdb, 3_600, function() use ($torrent) {
                            return App\Models\Cartoon::where('id', '=', $torrent->tmdb)->first();
                        })
                    @endphp
                @endif
            @endif
            @if ($torrent->category->game_meta)
                @if ($torrent->igdb || $torrent->igdb != 0)
                    @php $meta = MarcReichel\IGDBLaravel\Models\Game::with(['cover' => ['url', 'image_id'], 'genres' => ['name']])->find($torrent->igdb) @endphp
                @endif
            @endif

            <div class="col-md-4">
                <div class="card is-torrent">
                    <div class="card_head">
							<span class="badge-user text-bold" style="float:right;">
								<i class="{{ config('other.font-awesome') }} fa-fw fa-arrow-up text-green"></i>
								{{ $torrent->seeders }} /
								<i class="{{ config('other.font-awesome') }} fa-fw fa-arrow-down text-red"></i>
								{{ $torrent->leechers }} /
								<i class="{{ config('other.font-awesome') }} fa-fw fa-check text-orange"></i>
								{{ $torrent->times_completed }}
							</span>&nbsp;
                        <span class="badge-user text-bold text-blue" style="float:right;">
								{{ $torrent->getSize() }}
							</span>&nbsp;
                        <span class="badge-user text-bold text-blue" style="float:right;">
								{{ $torrent->resolution->name ?? 'No Res' }}
							</span>
                        <span class="badge-user text-bold text-blue" style="float:right;">
								{{ $torrent->type->name }}
							</span>&nbsp;
                        <span class="badge-user text-bold text-blue" style="float:right;">
								{{ $torrent->category->name }}
							</span>&nbsp;
                    </div>
                    <div class="card_body">
                        <div class="body_poster">
                            @if ($torrent->category->movie_meta || $torrent->category->tv_meta)
                                @if(file_exists(public_path().'/files/img/torrent-cover_'.$torrent->id.'.jpg'))
                                    <img src="{{ url('files/img/torrent-cover_' . $torrent->id . '.jpg') }}"
                                        class="show-poster" alt="{{ $torrent->name }}">
                                @else
                                    <img src="{{ isset($meta->poster) ? tmdb_image('poster_mid', $meta->poster) : '/img/SLOshare/movie_no_image_holder_200x300.jpg' }}"
                                        class="show-poster" alt="{{ $torrent->name }}">
                                @endif
                            @endif

                            @if ($torrent->category->cartoon_meta)
                                @if(file_exists(public_path().'/files/img/torrent-cover_'.$torrent->id.'.jpg'))
                                    <img src="{{ url('files/img/torrent-cover_' . $torrent->id . '.jpg') }}"
                                        class="show-poster" alt="{{ $torrent->name }}">
                                @else
                                    <img src="{{ isset($meta->poster) ? tmdb_image('poster_mid', $meta->poster) : '/img/SLOshare/cartoon_no_image_200x300.jpg' }}"
                                        class="show-poster" alt="{{ $torrent->name }}">
                                @endif
                            @endif

                            @if ($torrent->category->game_meta && isset($meta) && $meta->cover['image_id'] && $meta->name)
                                <img src="https://images.igdb.com/igdb/image/upload/t_cover_big/{{ $meta->cover['image_id'] }}.jpg"
                                     class="show-poster"
                                     data-name='<i style="color: #a5a5a5;">{{ $meta->name ?? 'N/A' }}</i>'
                                     data-image='<img src="https://images.igdb.com/igdb/image/upload/t_original/{{ $meta->cover['image_id'] }}.jpg"
									     alt="{{ $torrent->name }}" style="height: 1000px;">'
                                     class="torrent-poster-img-small show-poster" alt="{{ $torrent->name }}">
                            @endif

                            @if ($torrent->category->music_meta)
                                @if(file_exists(public_path().'/files/img/torrent-cover_'.$torrent->id.'.jpg'))
                                    <img src="{{ url('files/img/torrent-cover_' . $torrent->id . '.jpg') }}"
                                        class="show-poster" alt="{{ $torrent->name }}">
                                @else
                                    <img src="/img/SLOshare/music_no_image_holder_200x300.jpg" class="show-poster" alt="{{ $torrent->name }}">
                                @endif
                            @endif

                            @if ($torrent->category->no_meta)
                                @if(file_exists(public_path().'/files/img/torrent-cover_'.$torrent->id.'.jpg'))
                                    <img src="{{ url('files/img/torrent-cover_' . $torrent->id . '.jpg') }}"
                                        class="show-poster" alt="{{ $torrent->name }}">
                                @else
                                    <img src="/img/SLOshare/meta_no_image_holder_200x300.jpg" class="show-poster" alt="{{ $torrent->name }}">
                                @endif
                            @endif
                        </div>
                        <div class="body_description">
                            <h3 class="description_title">
                                <a href="{{ route('torrent', ['id' => $torrent->id]) }}">
                                    {{ $torrent->name }}
                                </a>
                            </h3>
                            @if (isset($meta->genres) && ($torrent->category->movie_meta || $torrent->category->tv_meta || $torrent->category->cartoon_meta))
                                @foreach ($meta->genres as $genre)
                                    <span class="genre-label">
                                        <a href="{{ route('mediahub.genres.show', ['id' => $genre->id]) }}">
                                            <i class="{{ config('other.font-awesome') }} fa-theater-masks"></i> {{ $genre->name }}
                                        </a>
                                    </span>
                                @endforeach
                            @endif
                            @if (isset($meta->genres) && $torrent->category->game_meta)
                                @foreach ($meta->genres as $genre)
                                    <span class="genre-label">
                                        <i class="{{ config('other.font-awesome') }} fa-theater-masks"></i> {{ $genre['name'] }}
                                    </span>
                                @endforeach
                            @endif
                            <p class="description_plot">
                                @if($torrent->category->movie_meta || $torrent->category->tv_meta || $torrent->category->cartoon_meta)
                                    {{ $meta->overview ?? '' }}
                                @endif

                                @if($torrent->category->game_meta)
                                    {{ $meta->summary ?? '' }}
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="card_footer">
                        <div style="float: left;">
                            @if ($torrent->anon == 1)
                                <span class="badge-user text-orange text-bold">{{ strtoupper(__('common.anonymous')) }}
                                    @if ($user->id === $torrent->user->id || $user->group->is_modo)
                                        <a href="{{ route('users.show', ['username' => $torrent->user->username]) }}">
												({{ $torrent->user->username }})
											</a>
                                    @endif
									</span>
                            @else
                                <a href="{{ route('users.show', ['username' => $torrent->user->username]) }}">
										<span class="badge-user text-bold"
                                              style="color:{{ $torrent->user->group->color }}; background-image:{{ $torrent->user->group->effect }};">
											<i class="{{ $torrent->user->group->icon }}" data-toggle="tooltip"
                                               data-original-title="{{ $torrent->user->group->name }}"></i>
											{{ $torrent->user->username }}
										</span>
                                </a>
                            @endif
                        </div>
                        <span class="badge-user text-bold" style="float: right;">
								<i class="{{ config('other.font-awesome') }} fa-thumbs-up text-gold"></i>
								@if($torrent->category->movie_meta || $torrent->category->tv_meta || $torrent->category->cartoon_meta)
                                {{ round($meta->vote_average ?? 0) }}/10
                                ({{ $meta->vote_count ?? 0 }} {{ __('torrent.votes') }})
                            @endif
                            @if($torrent->category->game_meta)
                                {{ round($meta->rating ?? 0) }}/100
                                ({{ $meta->rating_count ?? 0 }} {{ __('torrent.votes') }})
                            @endif
							</span>
                    </div>
                </div>
            </div>
        @endforeach
        @if (! $torrents->count())
            <div class="margin-10 torrent-listings-no-result">
                {{ __('common.no-result') }}
            </div>
        @endif
		<table table class="table table-condensed table-striped table-bordered">
		</table>
        <br>
        <div class="text-center torrent-listings-pagination">
            {{ $torrents->links() }}
        </div>
        <br>
        <div class="container-fluid well torrent-listings-legend">
            <div class="text-center">
                <strong>{{ __('common.legend') }}:</strong>
                <button class='btn btn-success btn-circle torrent-listings-seeding' type='button' data-toggle='tooltip'
                        title=''
                        data-original-title='{{ __('torrent.currently-seeding') }}!'>
                    <i class='{{ config('other.font-awesome') }} fa-arrow-up'></i>
                </button>
                <button class='btn btn-warning btn-circle torrent-listings-leeching' type='button' data-toggle='tooltip'
                        title=''
                        data-original-title='{{ __('torrent.currently-leeching') }}!'>
                    <i class='{{ config('other.font-awesome') }} fa-arrow-down'></i>
                </button>
                <button class='btn btn-info btn-circle torrent-listings-incomplete' type='button' data-toggle='tooltip'
                        title=''
                        data-original-title='{{ __('torrent.not-completed') }}!'>
                    <i class='{{ config('other.font-awesome') }} fa-spinner'></i>
                </button>
                <button class='btn btn-danger btn-circle torrent-listings-complete' type='button' data-toggle='tooltip'
                        title=''
                        data-original-title='{{ __('torrent.completed-not-seeding') }}!'>
                    <i class='{{ config('other.font-awesome') }} fa-thumbs-down'></i>
                </button>
            </div>
        </div>
    </div>
</div>

<script nonce="{{ SLOYakuza\SecureHeaders\SecureHeaders::nonce('script') }}">
  document.addEventListener('livewire:load', function () {
    let myOptions = [
            @foreach($regions as $region)
      {
        label: "{{ $region->name }}", value: "{{ $region->id }}"
      },
        @endforeach
    ]
    VirtualSelect.init({
      ele: '#regions',
      options: myOptions,
      multiple: true,
      search: true,
      placeholder: "{{__('Izberite Regije')}}",
      noOptionsText: "{{__('Ni zadetkov')}}",
    })

    let regions = document.querySelector('#regions')
    regions.addEventListener('change', () => {
      let data = regions.value
    @this.set('regions', data)
    })

    let myOptions2 = [
            @foreach($distributors as $distributor)
      {
        label: "{{ $distributor->name }}", value: "{{ $distributor->id }}"
      },
        @endforeach
    ]
    VirtualSelect.init({
      ele: '#distributors',
      options: myOptions2,
      multiple: true,
      search: true,
      placeholder: "{{__('Izberite Distributorje')}}",
      noOptionsText: "{{__('Ni zadetkov')}}",
    })

    let distributors = document.querySelector('#distributors')
    distributors.addEventListener('change', () => {
      let data = distributors.value
    @this.set('distributors', data)
    })
  })
</script>

