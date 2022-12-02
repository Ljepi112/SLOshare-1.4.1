@extends('layout.default')

@section('title')
    <title>Skupine {{ __('torrent.torrents') }}</title>
@endsection

@section('meta')
    <meta name="description" content="{{ __('torrent.torrents') }} {{ config('other.title') }}">
@endsection

@section('breadcrumbs')
    <li class="breadcrumb--active">
        {{ __('torrent.torrents') }}
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
    <li class="nav-tabV2">
        <a class="nav-tab__link" href="{{ route('categories.index') }}">
            Kategorije
        </a>
    </li>
    <li class="nav-tab--active">
        <a class="nav-tab--active__link" href="{{ route('grouped') }}">
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
    <div>
        @livewire('torrent-group-search')
    </div>
@endsection
