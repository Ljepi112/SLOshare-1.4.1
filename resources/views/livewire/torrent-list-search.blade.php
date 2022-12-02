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
        <table class="table table-condensed table-striped table-bordered" id="torrent-list-table">
            <thead>
            <tr>
                <th class="torrent-listings-poster"></th>
                <th class="torrent-listings-format"></th>
                <th class="torrents-filename torrent-listings-overview">
                    <div sortable wire:click="sortBy('name')" :direction="$sortField === 'name' ? $sortDirection : null"
                         role="button">
                        {{ __('common.name') }}
                        @include('livewire.includes._sort-icon', ['field' => 'name'])
                    </div>
                </th>
                <th class="torrent-listings-download text-center">
                    <div>
                        <i class="{{ config('other.font-awesome') }} fa-download"></i>
                    </div>
                </th>
                <th class="torrent-listings-tmdb text-center">
                    <div>
                        <i class="{{ config('other.font-awesome') }} fa-id-badge"></i>
                    </div>
                </th>
                <th class="torrent-listings-size text-center">
                    <div sortable wire:click="sortBy('size')" :direction="$sortField === 'size' ? $sortDirection : null"
                         role="button">
                        <i class="{{ config('other.font-awesome') }} fa-database"></i>
                        @include('livewire.includes._sort-icon', ['field' => 'size'])
                    </div>
                </th>
                <th class="torrent-listings-seederstext-center">
                    <div sortable wire:click="sortBy('seeders')"
                         :direction="$sortField === 'seeders' ? $sortDirection : null" role="button">
                        <i class="{{ config('other.font-awesome') }} fa-arrow-alt-circle-up"></i>
                        @include('livewire.includes._sort-icon', ['field' => 'seeders'])
                    </div>
                </th>
                <th class="torrent-listings-leechers text-center">
                    <div sortable wire:click="sortBy('leechers')"
                         :direction="$sortField === 'leechers' ? $sortDirection : null" role="button">
                        <i class="{{ config('other.font-awesome') }} fa-arrow-alt-circle-down"></i>
                        @include('livewire.includes._sort-icon', ['field' => 'leechers'])
                    </div>
                </th>
                <th class="torrent-listings-completed text-center">
                    <div sortable wire:click="sortBy('times_completed')"
                         :direction="$sortField === 'times_completed' ? $sortDirection : null" role="button">
                        <i class="{{ config('other.font-awesome') }} fa-check-circle"></i>
                        @include('livewire.includes._sort-icon', ['field' => 'times_completed'])
                    </div>
                </th>
                <th class="torrent-listings-age text-center">
                    <div sortable wire:click="sortBy('created_at')"
                         :direction="$sortField === 'created_at' ? $sortDirection : null" role="button">
                        {{ __('common.created_at') }}
                        @include('livewire.includes._sort-icon', ['field' => 'created_at'])
                    </div>
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($torrents as $torrent)
                @php $meta = null @endphp
                @if ($torrent->category->tv_meta)
                    @if ($torrent->tmdb || $torrent->tmdb != 0)
                        @php $meta = cache()->remember('tvmeta:'.$torrent->tmdb.$torrent->category_id, 3_600, fn () => App\Models\Tv::select(['id', 'poster', 'vote_average'])->where('id', '=', $torrent->tmdb)->first()) @endphp
                    @endif
                @endif
                @if ($torrent->category->movie_meta)
                    @if ($torrent->tmdb || $torrent->tmdb != 0)
                        @php $meta = cache()->remember('moviemeta:'.$torrent->tmdb.$torrent->category_id, 3_600, fn () => App\Models\Movie::select(['id', 'poster', 'vote_average'])->where('id', '=', $torrent->tmdb)->first()) @endphp
                    @endif
                @endif
                @if ($torrent->category->cartoon_meta)
                    @if ($torrent->tmdb || $torrent->tmdb != 0)
                        @php $meta = cache()->remember('moviemeta:'.$torrent->tmdb.$torrent->category_id, 3_600, fn () => App\Models\Cartoon::select(['id', 'poster', 'vote_average'])->where('id', '=', $torrent->tmdb)->first()) @endphp
                    @endif
                @endif
                @if ($torrent->category->game_meta)
                    @if ($torrent->igdb || $torrent->igdb != 0)
                        @php $meta = MarcReichel\IGDBLaravel\Models\Game::with(['cover' => ['url', 'image_id']])->find($torrent->igdb) @endphp
                    @endif
                @endif

                @if ($torrent->sticky == 1)
                    <tr class="success">
                @else
                    <tr>
                        @endif
                        <td class="torrent-listings-poster" style="width: 1%;">

                                <div class="torrent-poster pull-left">
                                    @if ($torrent->category->movie_meta || $torrent->category->tv_meta)
                                        @if(file_exists(public_path().'/files/img/torrent-cover_'.$torrent->id.'.jpg'))
                                            <img src="{{ url('files/img/torrent-cover_' . $torrent->id . '.jpg') }}" class="torrent-poster-img-small"  loading="lazy"  alt="{{ $torrent->name }}">
                                        @else
                                            <img src="{{ isset($meta->poster) ? tmdb_image('poster_small', $meta->poster) : '/img/SLOshare/movie_no_image_holder_90x135.jpg' }}"
                                                class="torrent-poster-img-small" loading="lazy" alt="{{ $torrent->name }}">
                                        @endif
                                    @endif

                                    @if ($torrent->category->cartoon_meta)
                                        @if(file_exists(public_path().'/files/img/torrent-cover_'.$torrent->id.'.jpg'))
                                            <img src="{{ url('files/img/torrent-cover_' . $torrent->id . '.jpg') }}" class="torrent-poster-img-small" loading="lazy" alt="{{ $torrent->name }}">
                                        @else
                                            <img src="{{ isset($meta->poster) ? tmdb_image('poster_small', $meta->poster) : '/img/SLOshare/cartoon_no_image_90x135.jpg' }}"
                                                class="torrent-poster-img-small" loading="lazy" alt="{{ $torrent->name }}">
                                        @endif
                                    @endif

                                    @if ($torrent->category->game_meta)
                                        <img style="height: 80px;" src="{{ isset($meta->cover) ? 'https://images.igdb.com/igdb/image/upload/t_cover_small_2x/'.$meta->cover['image_id'].'.png' : '/img/SLOshare/games_no_image_90x135.jpg' }}"
                                            class="torrent-poster-img-small"  loading="lazy" alt="{{ $torrent->name }}">
                                    @endif

                                    @if ($torrent->category->music_meta)
                                        @if(file_exists(public_path().'/files/img/torrent-cover_'.$torrent->id.'.jpg'))
                                            <img src="{{ url('files/img/torrent-cover_' . $torrent->id . '.jpg') }}" class="torrent-poster-img-small" loading="lazy" alt="{{ $torrent->name }}">
                                        @else
                                            <img src="/img/SLOshare/music_no_image_holder_90x135.jpg" class="torrent-poster-img-small" loading="lazy" alt="{{ $torrent->name }}">
                                        @endif
                                    @endif

                                    @if ($torrent->category->no_meta)
                                        @if(file_exists(public_path().'/files/img/torrent-cover_'.$torrent->id.'.jpg'))
                                            <img src="{{ url('files/img/torrent-cover_' . $torrent->id . '.jpg') }}" class="torrent-poster-img-small" loading="lazy" alt="{{ $torrent->name }}">
                                        @else
                                            <img src="/img/SLOshare/meta_no_image_holder_90x135.jpg" class="torrent-poster-img-small" loading="lazy" alt="{{ $torrent->name }}">
                                        @endif
                                    @endif
                                </div>

                        <td class="torrent-listings-format" style="width: 5%; text-align: center;">
                            <div class="text-center">
                                <i class="{{ $torrent->category->icon }} torrent-icon"
                                   style="@if ($torrent->category->movie_meta || $torrent->category->tv_meta || $torrent->category->cartoon_meta) padding-top: 1px; @else padding-top: 15px; @endif font-size: 24px;"></i>
                            </div>
                            <div class="text-center">
                                <span class="label label-success" style="font-size: 13px">
                                    {{ $torrent->type->name }}
                                </span>
                            </div>
                            @if ($torrent->category->movie_meta || $torrent->category->tv_meta || $torrent->category->cartoon_meta)
                                <div class="text-center" style="padding-top: 5px;">
                                <span class="label label-success" style="font-size: 13px">
                                    {{ $torrent->resolution->name ?? 'N/A' }}
                                </span>
                                </div>
                            @endif
                        </td>
                        <td class="torrent-listings-overview" style="vertical-align: middle;">
                            @if($user->group->is_modo || $user->id === $torrent->user_id)
                                <a href="{{ route('edit_form', ['id' => $torrent->id]) }}">
                                    <button class="btn btn-primary btn-circle" type="button" data-toggle="tooltip"
                                            data-original-title="{{ __('common.edit') }}">
                                        <i class="{{ config('other.font-awesome') }} fa-pencil-alt"></i>
                                    </button>
                                </a>
                            @endif
                            <a class="view-torrent torrent-listings-name" style="font-size: 16px;"
                               href="{{ route('torrent', ['id' => $torrent->id]) }}">
                                {{ $torrent->name }}
                            </a>
                            @if ($current = $user->history->where('info_hash', $torrent->info_hash)->first())
                                @if ($current->seeder == 1 && $current->active == 1)
                                    <button class="btn btn-success btn-circle torrent-listings-seeding" type="button"
                                            data-toggle="tooltip"
                                            data-original-title="{{ __('torrent.currently-seeding') }}!">
                                        <i class="{{ config('other.font-awesome') }} fa-arrow-up"></i>
                                    </button>
                                @endif

                                @if ($current->seeder == 0 && $current->active == 1)
                                    <button class="btn btn-warning btn-circle torrent-listings-leeching" type="button"
                                            data-toggle="tooltip"
                                            data-original-title="{{ __('torrent.currently-leeching') }}!">
                                        <i class="{{ config('other.font-awesome') }} fa-arrow-down"></i>
                                    </button>
                                @endif

                                @if ($current->seeder == 0 && $current->active == 0 && $current->completed_at == null)
                                    <button class="btn btn-info btn-circle torrent-listings-incomplete" type="button"
                                            data-toggle="tooltip"
                                            data-original-title="{{ __('torrent.not-completed') }}!">
                                        <i class="{{ config('other.font-awesome') }} fa-spinner"></i>
                                    </button>
                                @endif

                                @if ($current->seeder == 1 && $current->active == 0 && $current->completed_at != null)
                                    <button class="btn btn-danger btn-circle torrent-listings-complete" type="button"
                                            data-toggle="tooltip"
                                            data-original-title="{{ __('torrent.completed-not-seeding') }}!">
                                        <i class="{{ config('other.font-awesome') }} fa-thumbs-down"></i>
                                    </button>
                                @endif
                            @endif
                            <br>
                            @if ($torrent->anon === 0)
                                <span class="torrent-listings-uploader">
									<i class="{{ config('other.font-awesome') }} {{ $torrent->user->group->icon }}"></i>
                                    <a href="{{ route('users.show', ['username' => $torrent->user->username]) }}">
                                        {{ $torrent->user->username }}
                                    </a>
                                </span> |
                            @else
                                <span class="torrent-listings-uploader">
									<i class="{{ config('other.font-awesome') }} fa-ghost"></i>
									{{ strtoupper(__('common.anonymous')) }}
                                    @if ($user->group->is_modo || $torrent->user->username === $user->username)
                                        <a href="{{ route('users.show', ['username' => $torrent->user->username]) }}">
                                            ({{ $torrent->user->username }})
                                        </a>
                                    @endif
                                </span> |
                            @endif
                            <span class='text-pink torrent-listings-thanks'>
                                    <i class="{{ config('other.font-awesome') }} fa-heartbeat"></i> {{ $torrent->thanks_count }}
                                </span> |
                            <span class='text-green torrent-listings-comments'>
									<i class="{{ config('other.font-awesome') }} fa-comment-alt-lines"></i> {{ $torrent->comments_count }}
								</span>
                            @if ($torrent->internal == 1)
                                 | <span class='text-bold torrent-listings-internal'>
                                    <i class='{{ config('other.font-awesome') }} fa-magic' data-toggle='tooltip'
                                       title=''
                                       data-original-title='{{ __('torrent.internal-release') }}'
                                       style="color: #baaf92;"></i>
                                </span>
                            @endif

                            <!--@if ($torrent->personal_release == 1)
                                 | <span class='text-bold torrent-listings-personal'>
                                    <i class='{{ config('other.font-awesome') }} fa-user-plus' data-toggle='tooltip'
                                       title=''
                                       data-original-title='Osebna Izdaja' style="color: #865be9;"></i>
                                </span>
                            @endif-->

                            @if ($torrent->stream == 1)
                                 | <span class='text-bold torrent-listings-stream-optimized'>
                                    <i class='{{ config('other.font-awesome') }} fa-play text-red' data-toggle='tooltip'
                                       title='' data-original-title='{{ __('torrent.stream-optimized') }}'></i>
                                </span>
                            @endif

                            @if ($torrent->featured == 0)
                                @if ($torrent->doubleup == 1)
                                     | <span class='text-bold torrent-listings-double-upload'>
                                        <i class='{{ config('other.font-awesome') }} fa-gem text-green'
                                           data-toggle='tooltip'
                                           title='' data-original-title='{{ __('torrent.double-upload') }}'></i>
                                    </span>
                                    @if ($torrent->du_until !== null)
                                         | <span class='text-bold torrent-listings-double-upload'>
                                            <i class='{{ config('other.font-awesome') }} fa-clock' data-toggle='tooltip'
                                               title='{{ Illuminate\Support\Carbon::now()->diffForHumans($torrent->du_until) }} Double Upload expires.'></i>
                                        </span>
                                    @endif
                                @endif

                                @if ($torrent->free >= '90')
                                     | <span class="text-bold torrent-listings-freeleech" data-toggle="tooltip"
                                          title='' data-original-title='{{ $torrent->free }}% {{ __('common.free') }}'>
                                            <i class="{{ config('other.font-awesome') }} fa-star text-gold"></i>
                                        </span>
                                @elseif ($torrent->free < '90' && $torrent->free >= '30')
                                    <style>
                                        .star50 {
                                            position: relative;
                                        }

                                        .star50:after {
                                            content: "\f005";
                                            position: absolute;
                                            left: 0;
                                            top: 0;
                                            width: 50%;
                                            overflow: hidden;
                                            color: #FFB800;
                                        }
                                    </style>
                                     | <span class="text-bold torrent-listings-freeleech" data-toggle="tooltip"
                                          title='' data-original-title='{{ $torrent->free }}% {{ __('common.free') }}'>
                                            <i class="star50 {{ config('other.font-awesome') }} fa-star"></i>
                                        </span>
                                @elseif ($torrent->free < '30' && $torrent->free != '0')
                                    <style>
                                        .star30 {
                                            position: relative;
                                        }

                                        .star30:after {
                                            content: "\f005";
                                            position: absolute;
                                            left: 0;
                                            top: 0;
                                            width: 30%;
                                            overflow: hidden;
                                            color: #FFB800;
                                        }
                                    </style>
                                     | <span class="text-bold torrent-listings-freeleech" data-toggle="tooltip"
                                          title='' data-original-title='{{ $torrent->free }}% {{ __('common.free') }}'>
                                            <i class="star30 {{ config('other.font-awesome') }} fa-star"></i>
                                        </span>
                                @endif
                                    @if ($torrent->fl_until !== null)
                                         | <span class='text-bold torrent-listings-freeleech'>
                                            <i class='{{ config('other.font-awesome') }} fa-clock' data-toggle='tooltip'
                                               title='{{ Illuminate\Support\Carbon::now()->diffForHumans($torrent->fl_until) }} Freeleech expires.'></i>
                                        </span>
                                    @endif
                            @endif

                            @if ($personalFreeleech)
                                |  <span class='text-bold torrent-listings-personal-freeleech'>
                                    <i class='{{ config('other.font-awesome') }} fa-id-badge text-orange'
                                       data-toggle='tooltip'
                                       title='' data-original-title='{{ __('torrent.personal-freeleech') }}'></i>
                                </span>
                            @endif

                            @if ($user->freeleechTokens->where('torrent_id', $torrent->id)->first())
                                 | <span class='text-bold torrent-listings-freeleech-token'>
                                    <i class='{{ config('other.font-awesome') }} fa-star text-bold'
                                       data-toggle='tooltip'
                                       title='' data-original-title='{{ __('torrent.freeleech-token') }}'></i>
                                </span>
                            @endif

                            @if ($torrent->featured == 1)
                                 | <span class='text-bold torrent-listings-featured'
                                      style='background-image:url(/img/sparkels.gif);'>
                                    <i class='{{ config('other.font-awesome') }} fa-certificate text-pink'
                                       data-toggle='tooltip'
                                       title='' data-original-title='{{ __('torrent.featured') }}'></i>
                                </span>
                            @endif

                            @if ($user->group->is_freeleech == 1)
                                 | <span class='text-bold torrent-listings-special-freeleech'>
                                    <i class='{{ config('other.font-awesome') }} fa-trophy text-purple'
                                       data-toggle='tooltip'
                                       title='' data-original-title='{{ __('torrent.special-freeleech') }}'></i>
                                </span>
                            @endif

                            @if (config('other.freeleech') == 1)
                                 | <span class='text-bold torrent-listings-global-freeleech'>
                                    <i class='{{ config('other.font-awesome') }} fa-globe text-blue'
                                       data-toggle='tooltip'
                                       title='' data-original-title='{{ __('torrent.global-freeleech') }}'></i>
                                </span>
                            @endif

                            @if (config('other.doubleup') == 1)
                                 | <span class='text-bold torrent-listings-global-double-upload'>
                                    <i class='{{ config('other.font-awesome') }} fa-globe text-green'
                                       data-toggle='tooltip'
                                       title='' data-original-title='{{ __('torrent.global-double-upload') }}'></i>
                                </span>
                            @endif

                            @if ($user->group->is_double_upload == 1)
                                 | <span class='text-bold torrent-listings-special-double-upload'>
									<i class='{{ config('other.font-awesome') }} fa-trophy text-purple'
                                       data-toggle='tooltip' title=''
                                       data-original-title='{{ __('torrent.special-double_upload') }}'></i>
								</span>
                            @endif

                            @if ($torrent->leechers >= 5)
                                 | <span class='text-bold torrent-listings-hot'>
                                    <i class='{{ config('other.font-awesome') }} fa-fire text-orange'
                                       data-toggle='tooltip'
                                       title='' data-original-title='{{ __('common.hot') }}'></i>
                                </span>
                            @endif

                            @if ($torrent->sticky == 1)
                                 | <span class='text-bold torrent-listings-sticky'>
                                    <i class='{{ config('other.font-awesome') }} fa-thumbtack text-black'
                                       data-toggle='tooltip'
                                       title='' data-original-title='{{ __('torrent.sticky') }}'></i>
                                </span>
                            @endif

                            @if ($torrent->highspeed == 1)
                                 | <span class='text-bold torrent-listings-high-speed'>
									<i class='{{ config('other.font-awesome') }} fa-tachometer text-red'
                                       data-toggle='tooltip'
                                       title='' data-original-title='{{ __('common.high-speeds') }}'></i>
								</span>
                            @endif

                            @if ($torrent->sd == 1)
                                 | <span class='text-bold torrent-listings-sd'>
									<i class='{{ config('other.font-awesome') }} fa-ticket text-orange'
                                       data-toggle='tooltip'
                                       title='' data-original-title='{{ __('torrent.sd-content') }}'></i>
								</span>
                            @endif

                            @if ($torrent->bumped_at != $torrent->created_at && $torrent->bumped_at < Illuminate\Support\Carbon::now()->addDay(2))
                                 | <span class='text-bold torrent-listings-bumped'>
                                    <i class='{{ config('other.font-awesome') }} fa-level-up-alt text-red'
                                       data-toggle='tooltip'
                                       title='' data-original-title='{{ __('torrent.recent-bumped') }}'> {{ __('torrent.recent-bumped') }}</i>
                                </span>
                            @endif
                        </td>
                        <td class="torrent-listings-download text-center" style="vertical-align: middle;">
                            @if (config('torrent.download_check_page') == 1)
                                <a href="{{ route('download_check', ['id' => $torrent->id]) }}">
                                    <button class="btn btn-primary" type="button" data-toggle="tooltip"
                                            data-original-title="{{ __('common.download') }}">
                                        <i class="{{ config('other.font-awesome') }} fa-download"></i>
                                    </button>
                                </a>
                            @else
                                <a href="{{ route('download', ['id' => $torrent->id]) }}">
                                    <button class="btn btn-primary" type="button" data-toggle="tooltip"
                                            data-original-title="{{ __('common.download') }}">
                                        <i class="{{ config('other.font-awesome') }} fa-download"></i>
                                    </button>
                                </a>
                            @endif
                            @if (config('torrent.magnet') == 1)
                                <a href="magnet:?dn={{ $torrent->name }}&xt=urn:btih:{{ $torrent->info_hash }}&as={{ route('torrent.download.rsskey', ['id' => $torrent->id, 'rsskey' => $user->rsskey ]) }}&tr={{ route('announce', ['passkey' => $user->passkey]) }}&xl={{ $torrent->size }}">
                                    <button class="btn btn-primary" type="button" data-toggle="tooltip"
                                            data-original-title="{{ __('common.magnet') }}">
                                        <i class="{{ config('other.font-awesome') }} fa-magnet"></i>
                                    </button>
                                </a>
                            @endif
                                @livewire('small-bookmark-button', ['torrent' => $torrent->id], key($torrent->id))
                        </td>
                        <td class="torrent-listings-tmdb text-center" style="vertical-align: middle;">
                            @if ($torrent->category->game_meta)
										<img src="{{ url('img/igdb.png') }}" alt="igdb_id" style="margin-left: -5px;"
                                             width="24px" height="24px"> {{ $torrent->igdb }}
	                                    <br>
										<span class="{{ rating_color($meta->rating ?? 'text-white') }}"><i
                                                    class="{{ config('other.font-awesome') }} fa-star-half-alt"></i> {{ round($meta->rating ?? 0) }}/100 </span>
                            @endif
                            @if ($torrent->category->movie_meta || $torrent->category->tv_meta || $torrent->category->cartoon_meta)
                                <div id="imdb_id" style="display: none;">tt{{ $torrent->imdb }}</div>
	                                    <a href="{{ route('torrents.similar', ['category_id' => $torrent->category_id, 'tmdb' => $torrent->tmdb]) }}">
											<img src="{{ url('img/tmdb_small.png') }}" alt="tmdb_id"
                                                 style="margin-left: -5px;" width="24px" height="24px"> {{ $torrent->tmdb }}
	                                    </a>
	                                    <br>
										<span class="{{ rating_color($meta->vote_average ?? 'text-white') }}"><i
                                                    class="{{ config('other.font-awesome') }} fa-star-half-alt"></i> {{ $meta->vote_average ?? 0 }}/10 </span>
                            @endif
                        </td>
                        <td class="torrent-listings-size text-center" style="vertical-align: middle;">
                                {{ $torrent->getSize() }}
                        </td>
                        <td class="torrent-listings-seeders text-center" style="vertical-align: middle;">
@if (auth()->user()->group->is_modo)
                            <a href="{{ route('peers', ['id' => $torrent->id]) }}">
@endif
                                    <span class='text-green'>
	                                    {{ $torrent->seeders }}
                                    </span>
                            </a>
                        </td>
                        <td class="torrent-listings-leechers text-center" style="vertical-align: middle;">
@if (auth()->user()->group->is_modo)
                            <a href="{{ route('peers', ['id' => $torrent->id]) }}">
@endif
                                    <span class='text-red'>
	                                    {{ $torrent->leechers }}
                                    </span>
                            </a>
                        </td>
                        <td class="torrent-listings-completed text-center" style="vertical-align: middle;">
@if (auth()->user()->group->is_modo)
                            <a href="{{ route('history', ['id' => $torrent->id]) }}">
@endif
                                    <span class='text-orange'>
	                                    {{ $torrent->times_completed }}
                                    </span>
                            </a>
                        </td>
                        <td class="torrent-listings-age text-center" style="vertical-align: middle;">
								{{ date('d.m.Y', $torrent->created_at->getTimestamp()) }}
                        </td>
                    </tr>
                    @endforeach
            </tbody>
        </table>
        @if (! $torrents->count())
            <div class="margin-10 torrent-listings-no-result">
                {{ __('common.no-result') }}
            </div>
        @endif
        <br>
        <div class="text-center">
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
