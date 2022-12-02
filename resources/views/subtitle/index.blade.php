@extends('layout.default')

@section('title')
    <title>{{ __('common.subtitles') }}</title>
@endsection

@section('breadcrumbs')
    <li class="breadcrumb--active">
        {{ __('common.subtitles') }}
    </li>
@endsection

@section('content')
    <div>
        @livewire('subtitle-search')
    </div>
@endsection