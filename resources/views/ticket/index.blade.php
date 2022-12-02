@extends('layout.default')

@section('title')
    <title>{{ __('ticket.helpdesk') }}</title>
@endsection

@section('breadcrumbs')
    <li class="breadcrumb--active">
        {{ __('ticket.helpdesk') }}
    </li>
@endsection

@section('content')
    <style>
        td {
            vertical-align: middle !important;
        }
    </style>
    <div class="box container">
        @livewire('ticket-search')
    </div>
@endsection
