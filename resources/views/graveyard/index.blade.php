@extends('layout.default')

@section('title')
    <title>{{ __('graveyard.graveyard') }}</title>
@endsection

@section('breadcrumbs')
    <li class="breadcrumb--active">
        {{ __('graveyard.graveyard') }}
    </li>
@endsection

@section('content')
    <div>
        @livewire('graveyard-search')
    </div>
@endsection
