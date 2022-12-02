@extends('layout.default')

@section('title')
    <title>{{ __('mediahub.cartoons') }}</title>
@endsection

@section('meta')
    <meta name="description" content="Cartoons">
@endsection

@section('breadcrumbs')
    <li class="breadcrumbV2">
        <a href="{{ route('mediahub.index') }}" class="breadcrumb__link">
            {{ __('mediahub.title') }}
        </a>
    </li>
    <li class="breadcrumb--active">
        {{ __('mediahub.cartoons') }}
    </li>
@endsection

@section('content')
    <div class="box container">
        @livewire('cartoon-search')
    </div>
@endsection
