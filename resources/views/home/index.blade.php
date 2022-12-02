@extends('layout.default')

@section('content')
    <div class="page__home">
        @include('blocks.ad_head')
        @include('blocks.news')
        @include('blocks.recommended')
        @include('blocks.stats')
        @include('blocks.poll')

        <!--@include('blocks.featured')-->

        @include('blocks.video')
        @include('blocks.ad_right')

        @include('blocks.torrents_torrents')
        @include('blocks.ad_center')
        @include('blocks.tops_torrents')
        <!--@include('blocks.top_torrents')-->
        <!--@include('blocks.top_uploaders')-->
        <!--@include('blocks.latest_topics')-->
        <!--@include('blocks.latest_posts')-->
        @include('blocks.online')
        @include('blocks.notification')
    </div>
@endsection