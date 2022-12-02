@extends('layout.default')

@section('title')
    <title>Seznam za spremljanje {{ __('common.search') }} - {{ __('staff.staff-dashboard') }}</title>
@endsection

@section('meta')
    <meta name="description" content="Watchlist Search - {{ __('staff.staff-dashboard') }}">
@endsection

@section('breadcrumbs')
    <li class="breadcrumbV2">
        <a href="{{ route('staff.dashboard.index') }}" class="breadcrumb__link">
            {{ __('staff.staff-dashboard') }}
        </a>
    </li>
    <li class="breadcrumb--active">
        Seznam za spremljanje
    </li>
@endsection

@section('page', 'page__watchlist--index')

@section('main')
    @livewire('watchlist-search')
@endsection
