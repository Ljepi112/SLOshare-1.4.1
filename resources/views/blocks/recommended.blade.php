	<section class="panelV2 table-responsive">

    <!-- Buttons -->
        <ul class="nav nav-tabs-user mb-5-user" role="tablist">
            <li class="active">
                <a href="#recommended-sloshare" role="tab" data-toggle="tab" aria-expanded="false">
                     <img src="{{ url('/icon-torrent.png') }}"> {{ __('sloshare.home-recommended-title') }}
                </a>
            </li>
            <li class="">
                <a href="#recommended-video" role="tab" data-toggle="tab" aria-expanded="true">
                    <i class="{{ config('other.font-awesome') }} fa-film"></i> {{ __('sloshare.home-movie-title') }}
                </a>
            </li>
            <!--<li class="">
                <a href="#recommended-tvseries" role="tab" data-toggle="tab" aria-expanded="true">
                    <i class="{{ config('other.font-awesome') }} fa-tv-retro"></i> {{ __('sloshare.home-tvseries-title') }}
                </a>
            </li>
            <li class="">
                <a href="#recommended-cartoones" role="tab" data-toggle="tab" aria-expanded="true">
                    <i class="{{ config('other.font-awesome') }} fa-baby"></i> {{ __('sloshare.home-cartoons-title') }}
                </a>
            </li>
            <li class="">
                <a href="#recommended-games" role="tab" data-toggle="tab" aria-expanded="true">
                    <i class="{{ config('other.font-awesome') }} fa-gamepad"></i> {{ __('sloshare.home-game-title') }}
                </a>
            </li>-->
        </ul>
    <!-- Buttons -->

<div class="tab-content">

           <div class="tab-pane fade active in" id="recommended-sloshare">
                <td class="table-responsive">
                    <table class="table table-condensed table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>{{ __('torrent.category') }}</th>
                                <th>{{ __('torrent.type') }}/{{ __('torrent.resolution') }}</th>
                                <th class="torrents-filename">{{ __('torrent.name') }}</th>
                                <th>{{ __('torrent.size') }}</th>
                                <th>{{ __('torrent.short-seeds') }}</th>
                                <th>{{ __('torrent.short-leechs') }}</th>
                                <th>{{ __('torrent.short-completed') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($slorecommended as $slorecommendeds)

                            @php $meta = null; @endphp
                            @if ($slorecommendeds->category->tv_meta)
                                @if ($slorecommendeds->tmdb || $slorecommendeds->tmdb != 0)
                            	    @php $meta = App\Models\Tv::where('id', '=', $slorecommendeds->tmdb)->first(); @endphp
                                @endif
                            @endif
                            @if ($slorecommendeds->category->movie_meta)
                                @if ($slorecommendeds->tmdb || $slorecommendeds->tmdb != 0)
                            	    @php $meta = App\Models\Movie::where('id', '=', $slorecommendeds->tmdb)->first(); @endphp
                                @endif
                            @endif
                            @if ($slorecommendeds->category->cartoon_meta)
                                @if ($slorecommendeds->tmdb || $slorecommendeds->tmdb != 0)
                            	    @php $meta = App\Models\Cartoon::where('id', '=', $slorecommendeds->tmdb)->first(); @endphp
                                @endif
                            @endif
                            @if ($slorecommendeds->category->cartoontv_meta)
                                @if ($slorecommendeds->tmdb || $slorecommendeds->tmdb != 0)
                            	    @php $meta = App\Models\Cartoontv::where('id', '=', $slorecommendeds->tmdb)->first(); @endphp
                                @endif
                            @endif
                            @if ($slorecommendeds->category->game_meta)
                                @if ($slorecommendeds->igdb || $slorecommendeds->igdb != 0)
                            	    @php $meta = MarcReichel\IGDBLaravel\Models\Game::with(['cover' => ['url', 'image_id']])->find($slorecommendeds->igdb); @endphp
                                @endif
                            @endif

                            <tr>
							    <td class="torrent-listings-poster" style="width: 1%;">
									<div class="torrent-poster pull-left">
										@if ($slorecommendeds->category->movie_meta || $slorecommendeds->category->tv_meta)
										    @if(file_exists(public_path().'/files/img/torrent-cover_'.$slorecommendeds->id.'.jpg'))
                                                <img src="{{ url('files/img/torrent-cover_' . $slorecommendeds->id . '.jpg') }}" class="torrent-poster-img-small" alt="{{ __('torrent.poster') }}">
											@else
											    <img src="{{ isset($meta->poster) ? \tmdb_image('poster_small', $meta->poster) : '/img/SLOshare/movie_no_image_holder_400x600.jpg' }}"
											        class="torrent-poster-img-small" alt="{{ __('torrent.poster') }}">
											@endif
										@endif

										@if ($slorecommendeds->category->cartoon_meta)
										    @if(file_exists(public_path().'/files/img/torrent-cover_'.$slorecommendeds->id.'.jpg'))
                                                <img src="{{ url('files/img/torrent-cover_' . $slorecommendeds->id . '.jpg') }}" class="torrent-poster-img-small" alt="{{ __('torrent.poster') }}">
											@else
											    <img src="{{ isset($meta->poster) ? \tmdb_image('poster_small', $meta->poster) : '/img/SLOshare/cartoon_no_image_400x600.jpg' }}"
											        class="torrent-poster-img-small" alt="{{ __('torrent.poster') }}">
											@endif
										@endif

										@if ($slorecommendeds->category->cartoontv_meta)
										    @if(file_exists(public_path().'/files/img/torrent-cover_'.$slorecommendeds->id.'.jpg'))
                                                <img src="{{ url('files/img/torrent-cover_' . $slorecommendeds->id . '.jpg') }}" class="torrent-poster-img-small" alt="{{ __('torrent.poster') }}">
											@else
											    <img src="{{ isset($meta->poster) ? \tmdb_image('poster_small', $meta->poster) : '/img/SLOshare/cartoon_no_image_400x600.jpg' }}"
											        class="torrent-poster-img-small" alt="{{ __('torrent.poster') }}">
											@endif
										@endif

										@if ($slorecommendeds->category->game_meta)
											<img style="height: 80px;" src="{{ isset($meta->cover) ? 'https://images.igdb.com/igdb/image/upload/t_cover_small_2x/'.$meta->cover['image_id'].'.png' : '/img/SLOshare/games_no_image_400x600.jpg' }}"
											     class="torrent-poster-img-small" alt="{{ __('torrent.poster') }}">
										@endif

										@if ($slorecommendeds->category->music_meta)
										    @if(file_exists(public_path().'/files/img/torrent-cover_'.$slorecommendeds->id.'.jpg'))
                                                <img src="{{ url('files/img/torrent-cover_' . $slorecommendeds->id . '.jpg') }}" class="torrent-poster-img-small" alt="{{ __('torrent.poster') }}">
											@else
											    <img src="('/img/SLOshare/music_no_image_holder_400x600.jpg')" class="torrent-poster-img-small" alt="{{ __('torrent.poster') }}">
                                            @endif
                                        @endif

                                        @if($slorecommendeds->category->no_meta)
										    @if(file_exists(public_path().'/files/img/torrent-cover_'.$slorecommendeds->id.'.jpg'))
                                                <img src="{{ url('files/img/torrent-cover_' . $slorecommendeds->id . '.jpg') }}" class="torrent-poster-img-small" alt="{{ __('torrent.poster') }}">
											@else
											    <img src="('/img/SLOshare/meta_no_image_holder_400x600.jpg')" class="torrent-poster-img-small" alt="{{ __('torrent.poster') }}">
                                            @endif
                                        @endif
                                </td>
                                <td style="width: 1%;">
                                    <div class="text-center" style="padding-top: 5px;">
                                        <span class="label label-success" data-toggle="tooltip"
                                            data-original-title="{{ __('torrent.type') }}">
                                            {{ $slorecommendeds->type->name }}
                                         </span>
                                    </div>
                                    <div class="text-center" style="padding-top: 8px;">
                                        <span class="label label-success" data-toggle="tooltip"
                                            data-original-title="{{ __('torrent.resolution') }}">
                                            {{ $slorecommendeds->resolution->name ?? 'No Res' }}
                                        </span>
                                    </div>
                                </td>

                                <td>
                                    <a class="text-bold" href="{{ route('torrent', ['id' => $slorecommendeds->id]) }}">
                                        {{ $slorecommendeds->name }}
                                    </a>
                                    @if (config('torrent.download_check_page') == 1)
                                    <a href="{{ route('download_check', ['id' => $slorecommendeds->id]) }}">
                                        <button class="btn btn-primary btn-circle" type="button" data-toggle="tooltip"
                                            data-original-title="{{ __('torrent.download-torrent') }}">
                                            <i class="{{ config('other.font-awesome') }} fa-download"></i>
                                        </button>
                                    </a>
                                    @else
                                    <a href="{{ route('download', ['id' => $slorecommendeds->id]) }}">
                                        <button class="btn btn-primary btn-circle" type="button" data-toggle="tooltip"
                                            data-original-title="{{ __('torrent.download-torrent') }}">
                                            <i class="{{ config('other.font-awesome') }} fa-download"></i>
                                        </button>
                                    </a>
                                    @endif

                                    <span data-toggle="tooltip" data-original-title="{{ __('torrent.bookmark') }}"
                                        custom="newTorrentBookmark{{ $slorecommendeds->id }}" id="newTorrentBookmark{{ $slorecommendeds->id }}"
                                        torrent="{{ $slorecommendeds->id }}"
                                        state="{{ $bookmarks->where('torrent_id', $slorecommendeds->id)->count() ? 1 : 0 }}"
                                        class="torrentBookmark">
                                    </span>

                                    <br>
								    @if ($slorecommendeds->anon === 0)
								    <span class="torrent-listings-uploader">
									    <i class="{{ config('other.font-awesome') }} {{ $slorecommendeds->user->group->icon }}"></i>
                                        <a href="{{ route('users.show', ['username' => $slorecommendeds->user->username]) }}">
                                            {{ $slorecommendeds->user->username }}
                                        </a>
                                    </span> |
								    @else
								    <span class="torrent-listings-uploader">
									    <i class="{{ config('other.font-awesome') }} fa-ghost"></i>
									    {{ strtoupper(trans('common.anonymous')) }}
								    @if ($user->group->is_modo || $slorecommendeds->user->username === $user->username)
									    <a href="{{ route('users.show', ['username' => $slorecommendeds->user->username]) }}">
                                            ({{ $slorecommendeds->user->username }})
                                        </a>
								    @endif
                                    </span> |
								    @endif

                                    <span class="text-pink">
                                        <i class="{{ config('other.font-awesome') }} fa-heart" data-toggle="tooltip"></i>
                                            {{ $slorecommendeds->thanks_count }}
                                    </span> |

                                    <span class="text-green">
                                        <i class="{{ config('other.font-awesome') }} fa-comment" data-toggle="tooltip"></i>
                                            {{ $slorecommendeds->comments_count }}
                                    </span>

                                    @if ($slorecommendeds->internal == 1)
                                    | <span class='text-bold'>
                                        <i class='{{ config('other.font-awesome') }} fa-magic' data-toggle='tooltip'
                                            title='' data-original-title='SLOshare' style="color: #baaf92;"></i>
                                            Internal
                                    </span>
                                    @endif

                                    @if ($slorecommendeds->stream == 1)
                                        | <span class='text-bold'>
                                            <i class='{{ config('other.font-awesome') }} fa-play text-red'
                                                data-toggle='tooltip' title='' data-original-title='{{ __('
                                                torrent.stream-optimized') }}'></i> {{ __('torrent.stream-optimized') }}
                                    </span>
                                    @endif

                                    @if ($slorecommendeds->featured == 0)
                                        @if ($slorecommendeds->doubleup == 1)
                                        | <span class='text-bold'>
                                            <i class='{{ config('other.font-awesome') }} fa-gem text-green'
                                                data-toggle='tooltip' title='' data-original-title='{{ __('torrent.double-upload') }}'></i>
                                        </span>
                                        @endif
                                        @if ($slorecommendeds->free == 1 || config('other.freeleech') == 1)
                                        | <span class='text-bold'>
                                            <i class='{{ config('other.font-awesome') }} fa-star text-gold'
                                                data-toggle='tooltip' title='' data-original-title='{{ __('torrent.freeleech') }}'></i>
                                        </span>
                                        @endif
                                    @endif

                                    @if ($personal_freeleech)
                                        | <span class='text-bold'>
                                            <i class='{{ config('other.font-awesome') }} fa-id-badge text-orange'
                                                data-toggle='tooltip' title='' data-original-title='{{ __('torrent.personal-freeleech') }}'></i>
                                        </span>
                                    @endif

                                    @if ($freeleech_tokens->where('torrent_id', $slorecommendeds->id)->count())
                                        | <span class='text-bold'>
                                            <i class='{{ config('other.font-awesome') }} fa-star text-bold'
                                                data-toggle='tooltip' title='' data-original-title='{{ __('torrent.freeleech-token') }}'></i>
                                        </span>
                                    @endif

                                    @if ($slorecommendeds->featured == 1)
                                        | <span class='text-bold'
                                            style='background-image:url(/img/sparkels.gif);'>
                                            <i class='{{ config('other.font-awesome') }} fa-certificate text-pink'
                                                data-toggle='tooltip' title='' data-original-title='{{ __('torrent.feature') }}'></i>
                                        </span>
                                    @endif

                                    @if ($user->group->is_freeleech == 1)
                                        | <span class='text-bold'>
                                            <i class='{{ config('other.font-awesome') }} fa-trophy text-purple'
                                                data-toggle='tooltip' title='' data-original-title='{{ __('torrent.special-freeleech') }}'></i>
                                        </span>
                                    @endif

                                    @if (config('other.doubleup') == 1)
                                        <span class='text-bold'>
                                            <i class='{{ config('other.font-awesome') }} fa-globe text-green'
                                                data-toggle='tooltip' title='' data-original-title='{{ __('torrent.global-double-upload') }}'></i>
                                        </span>
                                    @endif

                                    @if ($user->group->is_double_upload == 1)
                                        | <span class='text-bold'>
                                            <i class='{{ config('other.font-awesome') }} fa-trophy text-purple'
                                                data-toggle='tooltip' title='' data-original-title='{{ __('torrent.special-double_upload') }}'></i>
                                        </span>
                                    @endif

                                    @if ($slorecommendeds->leechers >= 5)
                                        <span class='text-bold'>
                                            <i class='{{ config('other.font-awesome') }} fa-fire text-orange'
                                                data-toggle='tooltip' title='' data-original-title='{{ __('common.hot') }}'></i>
                                        </span>
                                    @endif

                                    @if ($slorecommendeds->sticky == 1)
                                        <span class='text-bold'>
                                            | <i class='{{ config('other.font-awesome') }} fa-thumbtack text-black'
                                                data-toggle='tooltip' title='' data-original-title='{{ __('torrent.sticky') }}'></i>
                                        </span>
                                    @endif

                                    @if ($user->updated_at->getTimestamp() < $slorecommendeds->created_at->getTimestamp())
                                        |  <span class='text-bold'>
                                            <i class='{{ config('other.font-awesome') }} fa-magic text-green'
                                                data-toggle='tooltip' title='' data-original-title='{{ __('common.new') }}'></i>
                                        </span>
                                    @endif

                                    @if ($slorecommendeds->highspeed == 1)
                                        | <span class='text-bold'>
                                            <i class='{{ config('other.font-awesome') }} fa-tachometer text-red'
                                                data-toggle='tooltip' title='' data-original-title='{{ __('common.high-speeds') }}'></i>
                                        </span>
                                    @endif

                                    @if ($slorecommendeds->sd == 1)
                                        | <span class='text-bold'>
                                            <i class='{{ config('other.font-awesome') }} fa-ticket text-orange'
                                                data-toggle='tooltip' title='' data-original-title='{{ __('torrent.sd-content') }}'></i>
                                        </span>
                                    @endif
                                    </td>

                                    <td>
                                        <span>{{ $slorecommendeds->getSize() }}</span>
                                    </td>
                                    <td>
                                        <span>{{ $slorecommendeds->seeders }}</span>
                                    </td>
                                    <td>
                                        <span>{{ $slorecommendeds->leechers }}</span>
                                    </td>
                                    <td>
                                        <span>{{ $slorecommendeds->times_completed }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
            </div>

            <div class="tab-pane fade" id="recommended-video">
                <td class="table-responsive">
                    <table class="table table-condensed table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>{{ __('torrent.category') }}</th>
                                <th>{{ __('torrent.type') }}/{{ __('torrent.resolution') }}</th>
                                <th class="torrents-filename">{{ __('torrent.name') }}</th>
                                <th>{{ __('torrent.size') }}</th>
                                <th>{{ __('torrent.short-seeds') }}</th>
                                <th>{{ __('torrent.short-leechs') }}</th>
                                <th>{{ __('torrent.short-completed') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($videorecommended as $videorecommendeds)

                            @php $meta = null; @endphp
                            @if ($videorecommendeds->category->tv_meta)
                                @if ($videorecommendeds->tmdb || $videorecommendeds->tmdb != 0)
                            	    @php $meta = App\Models\Tv::where('id', '=', $videorecommendeds->tmdb)->first(); @endphp
                                @endif
                            @endif
                            @if ($videorecommendeds->category->movie_meta)
                                @if ($videorecommendeds->tmdb || $videorecommendeds->tmdb != 0)
                            	    @php $meta = App\Models\Movie::where('id', '=', $videorecommendeds->tmdb)->first(); @endphp
                                @endif
                            @endif
                            @if ($videorecommendeds->category->cartoon_meta)
                                @if ($videorecommendeds->tmdb || $videorecommendeds->tmdb != 0)
                            	    @php $meta = App\Models\Cartoon::where('id', '=', $videorecommendeds->tmdb)->first(); @endphp
                                @endif
                            @endif

                            <tr>
							    <td class="torrent-listings-poster" style="width: 1%;">
									<div class="torrent-poster pull-left">
										@if ($videorecommendeds->category->movie_meta || $videorecommendeds->category->tv_meta)
										    @if(file_exists(public_path().'/files/img/torrent-cover_'.$videorecommendeds->id.'.jpg'))
                                                <img src="{{ url('files/img/torrent-cover_' . $videorecommendeds->id . '.jpg') }}" class="torrent-poster-img-small" alt="{{ __('torrent.poster') }}">
											@else
											    <img src="{{ isset($meta->poster) ? \tmdb_image('poster_small', $meta->poster) : '/img/SLOshare/movie_no_image_holder_400x600.jpg' }}"
											        class="torrent-poster-img-small" alt="{{ __('torrent.poster') }}">
											@endif
										@endif

										@if ($videorecommendeds->category->cartoon_meta)
										    @if(file_exists(public_path().'/files/img/torrent-cover_'.$videorecommendeds->id.'.jpg'))
                                                <img src="{{ url('files/img/torrent-cover_' . $videorecommendeds->id . '.jpg') }}" class="torrent-poster-img-small" alt="{{ __('torrent.poster') }}">
											@else
											    <img src="{{ isset($meta->poster) ? \tmdb_image('poster_small', $meta->poster) : '/img/SLOshare/cartoon_no_image_400x600.jpg' }}"
											        class="torrent-poster-img-small" alt="{{ __('torrent.poster') }}">
											@endif
										@endif

										@if ($videorecommendeds->category->game_meta)
											<img style="height: 80px;" src="{{ isset($meta->cover) ? 'https://images.igdb.com/igdb/image/upload/t_cover_small_2x/'.$meta->cover['image_id'].'.png' : '/img/SLOshare/games_no_image_400x600.jpg' }}"
											     class="torrent-poster-img-small" alt="{{ __('torrent.poster') }}">
										@endif

										@if ($videorecommendeds->category->music_meta)
										    @if(file_exists(public_path().'/files/img/torrent-cover_'.$videorecommendeds->id.'.jpg'))
                                                <img src="{{ url('files/img/torrent-cover_' . $videorecommendeds->id . '.jpg') }}" class="torrent-poster-img-small" alt="{{ __('torrent.poster') }}">
											@else
											    <img src="('/img/SLOshare/music_no_image_holder_400x600.jpg')" class="torrent-poster-img-small" alt="{{ __('torrent.poster') }}">
                                            @endif
                                        @endif

                                        @if($videorecommendeds->category->no_meta)
										    @if(file_exists(public_path().'/files/img/torrent-cover_'.$videorecommendeds->id.'.jpg'))
                                                <img src="{{ url('files/img/torrent-cover_' . $videorecommendeds->id . '.jpg') }}" class="torrent-poster-img-small" alt="{{ __('torrent.poster') }}">
											@else
											    <img src="('/img/SLOshare/meta_no_image_holder_400x600.jpg')" class="torrent-poster-img-small" alt="{{ __('torrent.poster') }}">
                                            @endif
                                        @endif
                                </td>
                                <td style="width: 1%;">
                                    <div class="text-center" style="padding-top: 5px;">
                                        <span class="label label-success" data-toggle="tooltip"
                                            data-original-title="{{ __('torrent.type') }}">
                                            {{ $videorecommendeds->type->name }}
                                         </span>
                                    </div>
                                    <div class="text-center" style="padding-top: 8px;">
                                        <span class="label label-success" data-toggle="tooltip"
                                            data-original-title="{{ __('torrent.resolution') }}">
                                            {{ $videorecommendeds->resolution->name ?? 'No Res' }}
                                        </span>
                                    </div>
                                </td>

                                <td>
                                    <a class="text-bold" href="{{ route('torrent', ['id' => $videorecommendeds->id]) }}">
                                        {{ $videorecommendeds->name }}
                                    </a>
                                    @if (config('torrent.download_check_page') == 1)
                                    <a href="{{ route('download_check', ['id' => $videorecommendeds->id]) }}">
                                        <button class="btn btn-primary" type="button" data-toggle="tooltip"
                                            data-original-title="{{ __('torrent.download-torrent') }}">
                                            <i class="{{ config('other.font-awesome') }} fa-download"></i>
                                        </button>
                                    </a>
                                    @else
                                    <a href="{{ route('download', ['id' => $videorecommendeds->id]) }}">
                                        <button class="btn btn-primary" type="button" data-toggle="tooltip"
                                            data-original-title="{{ __('torrent.download-torrent') }}">
                                            <i class="{{ config('other.font-awesome') }} fa-download"></i>
                                        </button>
                                    </a>
                                    @endif

                                    <span data-toggle="tooltip" data-original-title="{{ __('torrent.bookmark') }}"
                                        custom="newTorrentBookmark{{ $videorecommendeds->id }}" id="newTorrentBookmark{{ $videorecommendeds->id }}"
                                        torrent="{{ $videorecommendeds->id }}"
                                        state="{{ $bookmarks->where('torrent_id', $videorecommendeds->id)->count() ? 1 : 0 }}"
                                        class="torrentBookmark">
                                    </span>

                                    <br>
								    @if ($videorecommendeds->anon === 0)
								    <span class="torrent-listings-uploader">
									    <i class="{{ config('other.font-awesome') }} {{ $videorecommendeds->user->group->icon }}"></i>
                                        <a href="{{ route('users.show', ['username' => $videorecommendeds->user->username]) }}">
                                            {{ $videorecommendeds->user->username }}
                                        </a>
                                    </span> |
								    @else
								    <span class="torrent-listings-uploader">
									    <i class="{{ config('other.font-awesome') }} fa-ghost"></i>
									    {{ strtoupper(trans('common.anonymous')) }}
								    @if ($user->group->is_modo || $videorecommendeds->user->username === $user->username)
									    <a href="{{ route('users.show', ['username' => $videorecommendeds->user->username]) }}">
                                            ({{ $videorecommendeds->user->username }})
                                        </a>
								    @endif
                                    </span> |
								    @endif

                                    <span class="text-pink">
                                        <i class="{{ config('other.font-awesome') }} fa-heart" data-toggle="tooltip"></i>
                                            {{ $videorecommendeds->thanks_count }}
                                    </span> |

                                    <span class="text-green">
                                        <i class="{{ config('other.font-awesome') }} fa-comment" data-toggle="tooltip"></i>
                                            {{ $videorecommendeds->comments_count }}
                                    </span>

                                    @if ($videorecommendeds->internal == 1)
                                    | <span class='text-bold'>
                                        <i class='{{ config('other.font-awesome') }} fa-magic' data-toggle='tooltip'
                                            title='' data-original-title='SLOshare' style="color: #baaf92;"></i>
                                            Internal
                                    </span>
                                    @endif

                                    @if ($videorecommendeds->stream == 1)
                                        | <span class='text-bold'>
                                            <i class='{{ config('other.font-awesome') }} fa-play text-red'
                                                data-toggle='tooltip' title='' data-original-title='{{ __('
                                                torrent.stream-optimized') }}'></i> {{ __('torrent.stream-optimized') }}
                                    </span>
                                    @endif

                                    @if ($videorecommendeds->featured == 0)
                                        @if ($videorecommendeds->doubleup == 1)
                                        | <span class='text-bold'>
                                            <i class='{{ config('other.font-awesome') }} fa-gem text-green'
                                                data-toggle='tooltip' title='' data-original-title='{{ __('torrent.double-upload') }}'></i>
                                        </span>
                                        @endif
                                        @if ($videorecommendeds->free == 1 || config('other.freeleech') == 1)
                                        | <span class='text-bold'>
                                            <i class='{{ config('other.font-awesome') }} fa-star text-gold'
                                                data-toggle='tooltip' title='' data-original-title='{{ __('torrent.freeleech') }}'></i>
                                        </span>
                                        @endif
                                    @endif

                                    @if ($personal_freeleech)
                                        | <span class='text-bold'>
                                            <i class='{{ config('other.font-awesome') }} fa-id-badge text-orange'
                                                data-toggle='tooltip' title='' data-original-title='{{ __('torrent.personal-freeleech') }}'></i>
                                        </span>
                                    @endif

                                    @if ($freeleech_tokens->where('torrent_id', $videorecommendeds->id)->count())
                                        | <span class='text-bold'>
                                            <i class='{{ config('other.font-awesome') }} fa-star text-bold'
                                                data-toggle='tooltip' title='' data-original-title='{{ __('torrent.freeleech-token') }}'></i>
                                        </span>
                                    @endif

                                    @if ($videorecommendeds->featured == 1)
                                        | <span class='text-bold'
                                            style='background-image:url(/img/sparkels.gif);'>
                                            <i class='{{ config('other.font-awesome') }} fa-certificate text-pink'
                                                data-toggle='tooltip' title='' data-original-title='{{ __('torrent.feature') }}'></i>
                                        </span>
                                    @endif

                                    @if ($user->group->is_freeleech == 1)
                                        | <span class='text-bold'>
                                            <i class='{{ config('other.font-awesome') }} fa-trophy text-purple'
                                                data-toggle='tooltip' title='' data-original-title='{{ __('torrent.special-freeleech') }}'></i>
                                        </span>
                                    @endif

                                    @if (config('other.doubleup') == 1)
                                        <span class='text-bold'>
                                            <i class='{{ config('other.font-awesome') }} fa-globe text-green'
                                                data-toggle='tooltip' title='' data-original-title='{{ __('torrent.global-double-upload') }}'></i>
                                        </span>
                                    @endif

                                    @if ($user->group->is_double_upload == 1)
                                        | <span class='text-bold'>
                                            <i class='{{ config('other.font-awesome') }} fa-trophy text-purple'
                                                data-toggle='tooltip' title='' data-original-title='{{ __('torrent.special-double_upload') }}'></i>
                                        </span>
                                    @endif

                                    @if ($videorecommendeds->leechers >= 5)
                                        <span class='text-bold'>
                                            <i class='{{ config('other.font-awesome') }} fa-fire text-orange'
                                                data-toggle='tooltip' title='' data-original-title='{{ __('common.hot') }}'></i>
                                        </span>
                                    @endif

                                    @if ($videorecommendeds->sticky == 1)
                                        <span class='text-bold'>
                                            | <i class='{{ config('other.font-awesome') }} fa-thumbtack text-black'
                                                data-toggle='tooltip' title='' data-original-title='{{ __('torrent.sticky') }}'></i>
                                        </span>
                                    @endif

                                    @if ($user->updated_at->getTimestamp() < $videorecommendeds->created_at->getTimestamp())
                                        |  <span class='text-bold'>
                                            <i class='{{ config('other.font-awesome') }} fa-magic text-green'
                                                data-toggle='tooltip' title='' data-original-title='{{ __('common.new') }}'></i>
                                        </span>
                                    @endif

                                    @if ($videorecommendeds->highspeed == 1)
                                        | <span class='text-bold'>
                                            <i class='{{ config('other.font-awesome') }} fa-tachometer text-red'
                                                data-toggle='tooltip' title='' data-original-title='{{ __('common.high-speeds') }}'></i>
                                        </span>
                                    @endif

                                    @if ($videorecommendeds->sd == 1)
                                        | <span class='text-bold'>
                                            <i class='{{ config('other.font-awesome') }} fa-ticket text-orange'
                                                data-toggle='tooltip' title='' data-original-title='{{ __('torrent.sd-content') }}'></i>
                                        </span>
                                    @endif
                                    </td>

                                    <td>
                                        <span>{{ $videorecommendeds->getSize() }}</span>
                                    </td>
                                    <td>
                                        <span>{{ $videorecommendeds->seeders }}</span>
                                    </td>
                                    <td>
                                        <span>{{ $videorecommendeds->leechers }}</span>
                                    </td>
                                    <td>
                                        <span>{{ $videorecommendeds->times_completed }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
            </div>

        </div>
	</section>