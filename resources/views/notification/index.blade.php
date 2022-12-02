@extends('layout.default')

@section('title')
    <title>{{ __('notification.notifications') }}</title>
@endsection

@section('breadcrumbs')
    <li class="breadcrumb--active">
        {{ __('notification.notifications') }}
    </li>
@endsection

@section('content')
    <div>
        @livewire('notification-search')
    </div>
@endsection
