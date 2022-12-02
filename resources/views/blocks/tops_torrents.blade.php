	<section class="panelV2 table-responsive">
    <!-- Buttons -->
    <ul class="nav nav-tabs-user mb-5-user" role="tablist">
        <li class="active">
            <a href="#seeders" role="tab" data-toggle="tab" aria-expanded="false">
                <i class="{{ config('other.font-awesome') }} fa-arrow-up"></i> {{ __('sloshare.home-seeders-title') }}
            </a>
        </li>
        <li class="">
            <a href="#leechers" role="tab" data-toggle="tab" aria-expanded="true">
                <i class="{{ config('other.font-awesome') }} fa-arrow-down"></i> {{ __('sloshare.home-leechers-title') }}
            </a>
        </li>
    </ul>
    <!-- Buttons -->
    <div class="tab-content">

        <div class="tab-pane fade active in" id="seeders">
            <section class="recommendations" style="max-height: 330px !important;">
                <div class="scroller" style="padding-bottom: 10px;">

                @foreach ($seeded as $seed)
                    @php $meta = null; @endphp
         		    @if ($seed->category->tv_meta)
         		         @if ($seed->tmdb || $seed->tmdb != 0)
         			            @php $meta = App\Models\Tv::where('id', '=', $seed->tmdb)->first(); @endphp
                         @endif
                    @endif
                    @if ($seed->category->movie_meta)
                        @if ($seed->tmdb || $seed->tmdb != 0)
         			        @php $meta = App\Models\Movie::where('id', '=', $seed->tmdb)->first(); @endphp
         			    @endif
                    @endif
         	        @if ($seed->category->cartoon_meta)
         		        @if ($seed->tmdb || $seed->tmdb != 0)
         			        @php $meta = App\Models\Cartoon::where('id', '=', $seed->tmdb)->first(); @endphp
         		        @endif
         	        @endif
         		    @if ($seed->category->cartoontv_meta)
         		         @if ($seed->tmdb || $seed->tmdb != 0)
         			            @php $meta = App\Models\Cartoontv::where('id', '=', $seed->tmdb)->first(); @endphp
                         @endif
                    @endif
         		    @if ($seed->category->game_meta)
         			    @if ($seed->igdb || $seed->igdb != 0)
         				    @php $meta = MarcReichel\IGDBLaravel\Models\Game::with(['cover' => ['url', 'image_id']])->find($seed->igdb); @endphp
         		        @endif
         		    @endif
                    <div class="item mini backdrop mini_card">
			            <div class="gallery-item"
				            @if ($seed->category->movie_meta || $seed->category->tv_meta)
                                @if(file_exists(public_path().'/files/img/torrent-cover_'.$seed->id.'.jpg'))
                                    style="background-image: url('{{ url('files/img/torrent-cover_' . $seed->id . '.jpg') }}');" class="show-poster" alt="{{ $seed->name }}>
                                @else
    							    style="background-image: url('{{ isset($meta->poster) ? tmdb_image('poster_mid', $meta->poster) : '/img/SLOshare/movie_no_image_holder_400x600.jpg' }}"
    							    class="show-poster" alt="{{ $seed->name }}>
    						    @endif
                            @endif
    			            @if ($seed->category->cartoon_meta)
                                @if(file_exists(public_path().'/files/img/torrent-cover_'.$seed->id.'.jpg'))
                                    style="background-image: url('{{ url('files/img/torrent-cover_' . $seed->id . '.jpg') }}');" class="show-poster" alt="{{ $seed->name }}>
                                @else
    							    style="background-image: url('{{ isset($meta->poster) ? tmdb_image('poster_mid', $meta->poster) : '/img/SLOshare/cartoon_no_image_400x600.jpg' }}"
    							    class="show-poster" alt="{{ $seed->name }}>
    						    @endif
                            @endif
    			            @if ($seed->category->cartoontv_meta)
                                @if(file_exists(public_path().'/files/img/torrent-cover_'.$seed->id.'.jpg'))
                                    style="background-image: url('{{ url('files/img/torrent-cover_' . $seed->id . '.jpg') }}');" class="show-poster" alt="{{ $seed->name }}>
                                @else
    							    style="background-image: url('{{ isset($meta->poster) ? tmdb_image('poster_mid', $meta->poster) : '/img/SLOshare/cartoon_no_image_400x600.jpg' }}"
    							    class="show-poster" alt="{{ $seed->name }}>
    						    @endif
                            @endif

                            @if ($seed->category->game_meta && isset($meta) && $meta->cover['image_id'] && $meta->name)
                                style="background-image: url('{{ isset($meta->cover) ? 'https://images.igdb.com/igdb/image/upload/t_cover_small_2x/'.$meta->cover['image_id'].'.png' : '/img/SLOshare/games_no_image_400x600.jpg' }}');')
                                class="show-poster" alt="{{ $seed->name }}>
                            @endif

                            @if ($seed->category->music_meta)
                                @if(file_exists(public_path().'/files/img/torrent-cover_'.$seed->id.'.jpg'))
                                    style="background-image: url('{{ url('files/img/torrent-cover_' . $seed->id . '.jpg') }}');" class="show-poster" alt="{{ $seed->name }}>
    						    @else
    						        style="background-image: url('/img/SLOshare/music_no_image_holder_400x600.jpg')" class="show-poster" alt="{{ $seed->name }}>
                                @endif
                            @endif

                            @if($seed->category->no_meta)
                                style="background-image: url('{{ url('files/img/torrent-cover_' . $seed->id . '.jpg') }}');" class="show-poster" alt={{ $seed->name }}>
                            @else
                                style="background-image: url('/img/SLOshare/meta_no_image_holder_400x600.jpg')" class="show-poster" alt={{ $seed->name }}>
                            @endif
				            <div class="release-info">

				            @if ($seed->free == '1' || $seed->free >= '90' || $seed->free < '90' && $seed->free >= '30' || $seed->free < '30' && $seed->free != '0' || config('other.freeleech') == '1')
					            <a href="{{ route('categories.show', ['id' => $seed->category->id]) }}" class="release-info-quality quality-sloshare">{{ $seed->category->name }} <span class="FL-torrent" title="{{ __('sloshare.freeleech') }}">{{ __('sloshare.fl') }}</span></a>
					        @else
					            <a href="{{ route('categories.show', ['id' => $seed->category->id]) }}" class="release-info-quality quality-sloshare">{{ $seed->category->name }}</a>
                            @endif

					            <a href="{{ route('torrent', ['id' => $seed->id]) }}"title="{{ $seed->name }}" class="release-info-title sloshare-title">@joypixels(Str::limit($seed->name, 50))</a>
					            <div class="release-info-container">
						            <div class="release-info-meta">{{ __('sloshare.files') }} <span class="badge-sloshare-primary">{{ $seed->files->count() }}</span> | {{ __('sloshare.comments') }} <span class="badge-sloshare-primary">{{ $seed->comments_count }}</span></div>

						            @if ($seed->category->game_meta)
						                <div class="release-info-meta"><a class="badge-status">IGDB: {{ $meta->rating_count ?? 0 }}/100</a></div>
						            @endif
                                    @if ($seed->tmdb != 0 && $seed->tmdb != null)
                                        <div class="release-info-meta"><a class="badge-status">TMDB: {{ $meta->vote_average ?? 0 }}/10</a></div>
                                    @endif

						            <div class="release-info-meta">{{ __('sloshare.added') }} {{ date('d.m.Y', $seed->created_at->getTimestamp()) }} | {{ date('h:m', $seed->created_at->getTimestamp()) }}</div>
						            <div class="release-info-meta">{{ __('sloshare.uppedby') }} {{ $seed->user->username }}</div>
					            </div>
					            <div class="release-info-rating">
						            <a class="release-info-rating-likes download-link" href="{{ route('download', ['id' => $seed->id]) }}" data-title-tooltip title="{{ __('sloshare.download') }}"><i class="fas fa-file-download"></i> {{ $seed->getSize() }}</a>
						            <div style="float: right;">
							            <span title="{{ __('sloshare.seeders') }}" data-title-tooltip class="badge-sloshare-success">{{ $seed->seeders }}</span>
							            <span title="{{ __('sloshare.leechers') }}" data-title-tooltip class="badge-sloshare-danger">{{ $seed->leechers }}</span>
						            </div>
					            </div>
				            </div>
				            <!--<span class="torrent-new" title="" data-title-tooltip></span>-->
			            </div>
		            </div>
                @endforeach
                </div>
            </section>
        </div>

        <div class="tab-pane fade" id="leechers">
            <section class="recommendations" style="max-height: 330px !important;">
                <div class="scroller" style="padding-bottom: 10px;">

                @foreach ($leeched as $leech)
                    @php $meta = null; @endphp
    			    @if ($leech->category->tv_meta)
    				    @if ($leech->tmdb || $leech->tmdb != 0)
    					    @php $meta = App\Models\Tv::where('id', '=', $leech->tmdb)->first(); @endphp
    				    @endif
                    @endif
    			    @if ($leech->category->movie_meta)
    			        @if ($leech->tmdb || $leech->tmdb != 0)
    					    @php $meta = App\Models\Movie::where('id', '=', $leech->tmdb)->first(); @endphp
    			        @endif
    			    @endif
    			    @if ($leech->category->cartoon_meta)
    				    @if ($leech->tmdb || $leech->tmdb != 0)
    					    @php $meta = App\Models\Cartoon::where('id', '=', $leech->tmdb)->first(); @endphp
    				    @endif
    			    @endif
    			    @if ($leech->category->cartoontv_meta)
    				    @if ($leech->tmdb || $leech->tmdb != 0)
    					    @php $meta = App\Models\Cartoontv::where('id', '=', $leech->tmdb)->first(); @endphp
    				    @endif
                    @endif
    			    @if ($leech->category->game_meta)
    				    @if ($leech->igdb || $leech->igdb != 0)
    			            @php $meta = MarcReichel\IGDBLaravel\Models\Game::with(['cover' => ['url', 'image_id']])->find($leech->igdb); @endphp
    				    @endif
    		        @endif
                    <div class="item mini backdrop mini_card">
			            <div class="gallery-item"
				            @if ($leech->category->movie_meta || $leech->category->tv_meta)
                                @if(file_exists(public_path().'/files/img/torrent-cover_'.$leech->id.'.jpg'))
                                    style="background-image: url('{{ url('files/img/torrent-cover_' . $leech->id . '.jpg') }}');" class="show-poster" alt="{{ $leech->name }}>
                                @else
    						        style="background-image: url('{{ isset($meta->poster) ? tmdb_image('poster_mid', $meta->poster) : '/img/SLOshare/movie_no_image_holder_400x600.jpg' }}"
    							    class="show-poster" alt="{{ $leech->name }}>
    						    @endif
                            @endif
    			            @if ($leech->category->cartoon_meta)
                                @if(file_exists(public_path().'/files/img/torrent-cover_'.$leech->id.'.jpg'))
                                    style="background-image: url('{{ url('files/img/torrent-cover_' . $leech->id . '.jpg') }}');" class="show-poster" alt="{{ $leech->name }}>
                                @else
    						        style="background-image: url('{{ isset($meta->poster) ? tmdb_image('poster_mid', $meta->poster) : '/img/SLOshare/cartoon_no_image_400x600.jpg' }}"
    							    class="show-poster" alt="{{ $leech->name }}>
    					        @endif
                            @endif
    			            @if ($leech->category->cartoontv_meta)
                                @if(file_exists(public_path().'/files/img/torrent-cover_'.$leech->id.'.jpg'))
                                    style="background-image: url('{{ url('files/img/torrent-cover_' . $leech->id . '.jpg') }}');" class="show-poster" alt="{{ $leech->name }}>
                                @else
    						        style="background-image: url('{{ isset($meta->poster) ? tmdb_image('poster_mid', $meta->poster) : '/img/SLOshare/cartoon_no_image_400x600.jpg' }}"
    							    class="show-poster" alt="{{ $leech->name }}>
    					        @endif
                            @endif

                            @if ($leech->category->game_meta && isset($meta) && $meta->cover['image_id'] && $meta->name)
                                style="background-image: url('{{ isset($meta->cover) ? 'https://images.igdb.com/igdb/image/upload/t_cover_small_2x/'.$meta->cover['image_id'].'.png' : '/img/SLOshare/games_no_image_400x600.jpg' }}');')
                                class="show-poster" alt="{{ $leech->name }}>
                            @endif

                            @if ($leech->category->music_meta)
                                @if(file_exists(public_path().'/files/img/torrent-cover_'.$leech->id.'.jpg'))
                                    style="background-image: url('{{ url('files/img/torrent-cover_' . $leech->id . '.jpg') }}');" class="show-poster" alt="{{ $leech->name }}>
    						    @else
    							    style="background-image: url('/img/SLOshare/music_no_image_holder_400x600.jpg')" class="show-poster" alt="{{ $leech->name }}>
                                @endif
                            @endif

                            @if($leech->category->no_meta)
                                style="background-image: url('{{ url('files/img/torrent-cover_' . $leech->id . '.jpg') }}');" class="show-poster" alt={{ $leech->name }}>
                            @else
                                style="background-image: url('/img/SLOshare/meta_no_image_holder_400x600.jpg')" class="show-poster" alt={{ $leech->name }}>
                            @endif
				            <div class="release-info">

				            @if ($leech->free == '1' || $leech->free >= '90' || $leech->free < '90' && $leech->free >= '30' || $leech->free < '30' && $leech->free != '0' || config('other.freeleech') == '1')
					            <a href="{{ route('categories.show', ['id' => $leech->category->id]) }}" class="release-info-quality quality-sloshare">{{ $leech->category->name }} <span class="FL-torrent" title="{{ __('sloshare.freeleech') }}">{{ __('sloshare.fl') }}</span></a>
					        @else
					            <a href="{{ route('categories.show', ['id' => $leech->category->id]) }}" class="release-info-quality quality-sloshare">{{ $leech->category->name }}</a>
                            @endif

					            <a href="{{ route('torrent', ['id' => $leech->id]) }}"title="{{ $leech->name }}" class="release-info-title sloshare-title">@joypixels(Str::limit($leech->name, 50))</a>
					            <div class="release-info-container">
						            <div class="release-info-meta">{{ __('sloshare.files') }} <span class="badge-sloshare-primary">{{ $leech->files->count() }}</span> | {{ __('sloshare.comments') }} <span class="badge-sloshare-primary">{{ $leech->comments_count }}</span></div>

						            @if ($leech->category->game_meta)
						                <div class="release-info-meta"><a class="badge-status">IGDB: {{ $meta->rating_count ?? 0 }}/100</a></div>
						            @endif
                                    @if ($leech->tmdb != 0 && $leech->tmdb != null)
                                        <div class="release-info-meta"><a class="badge-status">TMDB: {{ $meta->vote_average ?? 0 }}/10</a></div>
                                    @endif

						            <div class="release-info-meta">{{ __('sloshare.added') }} {{ date('d.m.Y', $leech->created_at->getTimestamp()) }} | {{ date('h:m', $leech->created_at->getTimestamp()) }}</div>
						            <div class="release-info-meta">{{ __('sloshare.uppedby') }} {{ $leech->user->username }}</div>
					            </div>
					            <div class="release-info-rating">
						            <a class="release-info-rating-likes download-link" href="{{ route('download', ['id' => $leech->id]) }}" data-title-tooltip title="{{ __('sloshare.download') }}"><i class="fas fa-file-download"></i> {{ $leech->getSize() }}</a>
						            <div style="float: right;">
							            <span title="{{ __('sloshare.seeders') }}" data-title-tooltip class="badge-sloshare-success">{{ $leech->seeders }}</span>
							            <span title="{{ __('sloshare.leechers') }}" data-title-tooltip class="badge-sloshare-danger">{{ $leech->leechers }}</span>
						            </div>
					            </div>
				            </div>
				            <!--<span class="torrent-new" title="" data-title-tooltip></span>-->
			            </div>
		            </div>
                @endforeach
                </div>
            </section>
        </div>
	</section>