@extends('layout.default')

@section('title')
    <title>{{ __('notification.notifications') }}</title>
@endsection

@section('breadcrumbs')
    <li class="breadcrumb--active">
        {{ __('notification.notifications') }}
    </li>
@endsection

@section('main')
    @livewire('notification-search')
@endsection
