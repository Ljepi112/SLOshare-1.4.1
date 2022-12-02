@extends('layout.default')

@section('title')
    <title>{{ __('request.requests') }}</title>
@endsection

@section('breadcrumbs')
    <li class="breadcrumb--active">
        {{ __('request.requests') }}
    </li>
@endsection

@section('content')
    @livewire('torrent-request-search')
@endsection
