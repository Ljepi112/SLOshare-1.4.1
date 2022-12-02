@extends('layout.default')

@section('title')
    <title>{{ __('torrent.categories') }} - {{ config('other.title') }}</title>
@endsection

@section('breadcrumbs')
    <li class="breadcrumbV2">
        <a class="breadcrumb__link" href="{{ route('categories.index') }}">
            {{ __('torrent.categories') }}
        </a>
    </li>
@endsection

@section('nav-tabs')
    <li class="nav-tabV2">
        <a class="nav-tab__link" href="{{ route('torrents') }}">
            Seznam
        </a>
    </li>
    <li class="nav-tabV2">
        <a class="nav-tab__link" href="{{ route('cards') }}">
            Kartice
        </a>
    </li>
    <li class="nav-tab--active">
        <a class="nav-tab--active__link" href="{{ route('categories.index') }}">
            Kategorije
        </a>
    </li>
    <li class="nav-tabV2">
        <a class="nav-tab__link" href="{{ route('grouped') }}">
            Skupine
        </a>
    </li>
    <li class="nav-tabV2">
        <a class="nav-tab__link" href="{{ route('top10.index') }}">
            Top 10
        </a>
    </li>
    <li class="nav-tabV2">
        <a class="nav-tab__link" href="{{ route('rss.index') }}">
            {{ __('rss.rss') }}
        </a>
    </li>
@endsection

@section('content')
    <div class="container box">
        <div class="header gradient green">
            <div class="inner_content">
                <h1>{{ __('torrent.categories') }}</h1>
            </div>
        </div>
        <div class="blocks">
            @foreach ($categories as $category)
                <a href="{{ route('categories.show', ['id' => $category->id]) }}">
                    <div class="general media_blocks">
                        <h2>
                            @if ($category->image != null)
                                <img src="{{ url('files/img/' . $category->image) }}" alt="{{ $category->name }}">
                            @else
                                <i class="{{ $category->icon }}"></i>
                            @endif
                            {{ $category->name }}
                        </h2>
                        <span></span>
                        <h2>{{ $category->torrents_count }}</h2>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endsection