@extends('layout.default')

@section('title')
    <title>{{ __('torrent.edit-torrent') }}</title>
@endsection

@section('breadcrumbs')
    <li class="breadcrumbV2">
        <a href="{{ route('torrents') }}" class="breadcrumb__link">
            {{ __('torrent.torrents') }}
        </a>
    </li>
    <li class="breadcrumbV2">
        <a href="{{ route('torrent', ['id' => $torrent->id]) }}" class="breadcrumb__link">
            {{ $torrent->name }}
        </a>
    </li>
    <li class="breadcrumb--active">
        {{ __('common.edit') }}
    </li>
@endsection

@section('content')
    <div class="container">
        <div class="col-md-12">
            <h2>{{ __('common.edit') }}: {{ $torrent->name }}</h2>
            <div class="block">
                <form role="form" method="POST" action="{{ route('edit', ['id' => $torrent->id]) }}"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title">{{ __('torrent.name-torrent') }}</label>
                        <label>
                            <input type="text" class="form-control" name="name" value="{{ $torrent->name }}" required>
                        </label>
                    </div>

                        <div class="form-group">
                            <label for="torrent-cover">{{ __('torrent.banner') }}</label>
                            <input class="upload-form-file" type="file" accept=".jpg, .jpeg, .png"
                                   name="torrent-cover">
                        </div>

                    <div class="form-group">
                        <label for="category_id">{{ __('torrent.category') }}</label>
                        <label>
                            <select name="category_id" class="form-control">
                                <option value="{{ $torrent->category->id }}" selected>{{ $torrent->category->name }}
                                    ({{ __('torrent.current') }})
                                </option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </label>
                    </div>

                    @if ($torrent->category->movie_meta || $torrent->category->tv_meta || $torrent->category->cartoon_meta)
                        <div class="form-group">
                            <label for="name">TMDB ID <b>({{ __('request.required') }})</b></label>
                            <br>
                            <label for="name">URL za TMDB ID: <a href="https://www.themoviedb.org/" target="_blank"><b>https://www.themoviedb.org/</b></a></label>
                            <label>
                                <input type="number" name="tmdb" value="{{ $torrent->tmdb }}" class="form-control"
                                       required>
                            </label>
                        </div>
                    @else
                        <input type="hidden" name="tmdb" value="0">
                    @endif

                    @if ($torrent->category->movie_meta || $torrent->category->tv_meta || $torrent->category->cartoon_meta)
                        <div class="form-group">
                            <label for="name">IMDB ID <b>({{ __('torrent.optional') }})</b></label>
                            <br>
                            <label for="name">URL za IMDB ID: <a href="https://www.imdb.com/" target="_blank"><b>https://www.imdb.com/</b></a></label>
                            <label>
                                <input type="number" name="imdb" value="{{ $torrent->imdb }}" class="form-control"
                                       required>
                            </label>
                        </div>
                    @else
                        <input type="hidden" name="imdb" value="0">
                    @endif

                    @if ($torrent->category->tv_meta)
                        <div class="form-group">
                            <label for="name">TVDB ID ({{ __('torrent.optional') }})</label>
                            <br>
                            <label for="name">URL za TVDB ID: <a href="https://www.thetvdb.com/" target="_blank"><b>https://www.thetvdb.com/</b></a></label>
                            <label>
                                <input type="number" name="tvdb" value="{{ $torrent->tvdb }}" class="form-control"
                                       required>
                            </label>
                        </div>
                    @else
                        <input type="hidden" name="tvdb" value="0">
                    @endif

                    @if ($torrent->category->movie_meta || $torrent->category->tv_meta || $torrent->category->cartoon_meta)
                        <div class="form-group">
                            <label for="name">MAL ID ({{ __('torrent.required-anime') }})</label>
                            <br>
                            <label for="name">URL za MAL ID: <a href="https://myanimelist.net/" target="_blank"><b>https://myanimelist.net/</b></a></label>
                            <label>
                                <input type="number" name="mal" value="{{ $torrent->mal }}" class="form-control"
                                       required>
                            </label>
                        </div>
                    @else
                        <input type="hidden" name="mal" value="0">
                    @endif

                    @if ($torrent->category->game_meta)
                        <div class="form-group">
                            <label for="name">IGDB ID <b>({{ __('torrent.required-games') }})</b></label>
                            <br>
                            <label for="name">URL za IGDB ID: <a href="https://www.igdb.com/discover" target="_blank"><b>https://www.igdb.com/discover</b></a></label>
                            <label>
                                <input type="number" name="igdb" value="{{ $torrent->igdb }}" class="form-control"
                                       required>
                            </label>
                        </div>
                    @else
                        <input type="hidden" name="igdb" value="0">
                    @endif

                    <div class="form-group">
                        <label for="name">{{ __('torrent.keywords') }} (<i>{{ __('torrent.keywords-example') }}</i>)</label>
                        <label>
                            <input type="text" name="keywords" value="{{ $keywords->implode(', ') }}" class="form-control">
                        </label>
                    </div>

                    <div class="form-group">
                        <label for="type">{{ __('torrent.type') }}</label>
                        <label>
                            <select name="type_id" class="form-control">
                                <option value="{{ $torrent->type->id }}" selected>{{ $torrent->type->name }}
                                    ({{ __('torrent.current') }})
                                </option>
                                @foreach ($types as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </label>
                    </div>

                    @if ($torrent->category->movie_meta || $torrent->category->tv_meta || $torrent->category->cartoon_meta)
                        <div class="form-group">
                            <label for="resolution_id">{{ __('torrent.resolution') }}</label>
                            <label>
                                <select name="resolution_id" class="form-control">
                                    @if (! $torrent->resolution)
                                        <option hidden="" disabled="disabled" selected="selected" value="">{{ __('torrent.select-resolution') }}
                                        </option>)
                                    @else
                                        <option value="{{ $torrent->resolution->id }}"
                                                selected>{{ $torrent->resolution->name }}
                                            ({{ __('torrent.current') }})
                                        </option>
                                    @endif
                                    @foreach ($resolutions as $resolution)
                                        <option value="{{ $resolution->id }}">{{ $resolution->name }}</option>
                                    @endforeach
                                </select>
                            </label>
                        </div>
                    @endif

                        <div class="form-group">
                            <label for="season_number">{{ __('torrent.season-number') }} <b>({{ __('request.required') }} za
                                    TV)</b></label>
                            <input type="number" name="season_number" id="season_number" class="form-control"
                                   value="{{ $torrent->season_number }}" required>
                        </div>

                        <div class="form__group--horizontal" x-show="cats[cat].type === 'tv'">
                            <label for="episode_number">{{ __('torrent.episode-number') }} <b>({{ __('request.required') }}za
                                    TV. Uporabite "0" za sezonske pakete.)</b></label>
                            <input type="number" name="episode_number" id="episode_number" class="form-control"
                                   value="{{ $torrent->episode_number }}" required>
                        </div>

                    @if($torrent->type->name === 'Celotni Disk')
                        <div class="form-group">
                            <label for="distributor_id">{{ __('torrent.distributor') }} (Samo za celoten disk)</label>
                            <label>
                                <select name="distributor_id" class="form-control">
                                    @if (! $torrent->distributor)
                                        <option hidden="" disabled="disabled" selected="selected" value="">{{ __('torrent.select-distributor') }}
                                        </option>)
                                    @else
                                        <option value="{{ $torrent->distributor->id }}"
                                                selected>{{ $torrent->distributor->name }}
                                            ({{ __('torrent.current') }})
                                        </option>
                                    @endif
                                    <option value="">Brez distributerja</option>
                                    @foreach ($distributors as $distributor)
                                        <option value="{{ $distributor->id }}">{{ $distributor->name }}</option>
                                    @endforeach
                                </select>
                            </label>
                        </div>

                        <div class="form-group">
                            <label for="region_id">{{ __('torrent.region') }}</label>
                            <label>
                                <select name="region_id" class="form-control">
                                    @if (! $torrent->region)
                                        <option hidden="" disabled="disabled" selected="selected" value="">{{ __('torrent.select-region') }}
                                        </option>)
                                    @else
                                        <option value="{{ $torrent->region->id }}" selected>{{ $torrent->region->name }}
                                            ({{ __('torrent.current') }})
                                        </option>
                                    @endif
                                    <option value="">No Region</option>
                                    @foreach ($regions as $region)
                                        <option value="{{ $region->id }}">{{ $region->name }}</option>
                                    @endforeach
                                </select>
                            </label>
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="description">{{ __('common.description') }}</label>
                        <label for="upload-form-description"></label>
                        <textarea id="editor" name="description" cols="30" rows="10"
                                  class="form-control">{{ $torrent->description }}</textarea>
                    </div>

                    <!--<div class="form-group">
                        <label for="description">{{ __('torrent.media-info') }}</label>
                        <label>
                            <textarea name="mediainfo" cols="30" rows="10"
                                      class="form-control">{{ $torrent->mediainfo }}</textarea>
                        </label>
                    </div>-->

                    <!--<div class="form-group">
                        <label for="description">BDInfo (Quick Summary)</label>
                        <label>
                            <textarea name="bdinfo" cols="30" rows="10"
                                      class="form-control">{{ $torrent->bdinfo }}</textarea>
                        </label>
                    </div>-->

@if (auth()->user()->group->is_admin)
                        <label for="hidden" class="control-label">{{ __('common.anonymous') }}?</label>
                        <div class="radio-inline">
                            <label><input type="radio" name="anonymous" @if ($torrent->anon == 1) checked
                                          @endif value="1">{{ __('common.yes') }}</label>
                        </div>
                        <div class="radio-inline">
                            <label><input type="radio" name="anonymous" @if ($torrent->anon == 0) checked
                                          @endif value="0">{{ __('common.no') }}</label>
                        </div>
                        <br>
@else
                        <input type="hidden" name="anonymous" value="0">
@endif
@if (auth()->user()->group->is_admin)
                    <label for="hidden" class="control-label">{{ __('torrent.stream-optimized') }}?</label>
                    <div class="radio-inline">
                        <label><input type="radio" name="stream" @if ($torrent->stream == 1) checked
                                      @endif value="1">{{ __('common.yes') }}</label>
                    </div>
                    <div class="radio-inline">
                        <label><input type="radio" name="stream" @if ($torrent->stream == 0) checked
                                      @endif value="0">{{ __('common.no') }}</label>
                    </div>
                    <br>
@else
                        <input type="hidden" name="stream" value="0">
@endif

@if (auth()->user()->group->is_admin)


                    <label for="hidden" class="control-label">{{ __('torrent.sd-content') }}?</label>
                    <div class="radio-inline">
                        <label><input type="radio" name="sd" @if ($torrent->sd == 1) checked
                                      @endif value="1">{{ __('common.yes') }}</label>
                    </div>
                    <div class="radio-inline">
                        <label><input type="radio" name="sd" @if ($torrent->sd == 0) checked
                                      @endif value="0">{{ __('common.no') }}</label>
                    </div>
                    <br>
@else
                        <input type="hidden" name="sd" value="0">
@endif

@if (auth()->user()->group->is_admin || auth()->user()->group->is_internal)
                        <label for="internal" class="control-label">{{ __('torrent.internal') }}?</label>
                        <div class="radio-inline">
                            <label><input type="radio" name="internal" @if ($torrent->internal == 1) checked
                                          @endif value="1">{{ __('common.yes') }}</label>
                        </div>
                        <div class="radio-inline">
                            <label><input type="radio" name="internal" @if ($torrent->internal == 0) checked
                                          @endif value="0">{{ __('common.no') }}</label>
                        </div>
                        <br>
@else
                        <input type="hidden" name="internal" value="{{ $torrent->internal }}">
@endif
@if (auth()->user()->group->is_admin)
                        <label for="personal" class="control-label">Personal Release?</label>
                        <div class="radio-inline">
                            <label><input type="radio" name="personal_release"
                                          @if ($torrent->personal_release == 1) checked
                                          @endif value="1">{{ __('common.yes') }}</label>
                        </div>
                        <div class="radio-inline">
                            <label><input type="radio" name="personal_release"
                                          @if ($torrent->personal_release == 0) checked
                                          @endif value="0">{{ __('common.no') }}</label>
                        </div>
@else
                        <input type="hidden" name="personal_release" value="{{ $torrent->personal_release }}">
@endif

                    <br>

                    @if (auth()->user()->group->is_freeleech)
                        <label for="freeleech" class="control-label">{{ __('torrent.freeleech') }}?</label>
                        <div class="radio-inline">
                            <label><input type="radio" name="free"
                                          @if ($torrent->free == 100) checked
                                          @endif value="100">100%</label>
                        </div>
                        <div class="radio-inline">
                            <label><input type="radio" name="free"
                                          @if ($torrent->free == 75) checked
                                          @endif value="75">75%</label>
                        </div>
                        <div class="radio-inline">
                            <label><input type="radio" name="free"
                                          @if ($torrent->free == 50) checked
                                          @endif value="50">50%</label>
                        </div>
                        <div class="radio-inline">
                            <label><input type="radio" name="free"
                                          @if ($torrent->free == 25) checked
                                          @endif value="25">25%</label>
                        </div>
                        <div class="radio-inline">
                            <label><input type="radio" name="free"
                                          @if ($torrent->free == 0) checked
                                          @endif value="0">{{ __('common.no') }}</label>
                        </div>
                    @else
                        <input type="hidden" name="free" value="0">
                    @endif

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">{{ __('torrent.edit-torrent') }}</button>
                    </div>
                    <br>
                </form>
            </div>
        </div>
@endsection
