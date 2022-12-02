@extends('layout.default')

@section('content')
	<div class="sidebar2 sidebar--inverse">
        @include('blocks.stats')
        @include('blocks.poll')
        @include('blocks.ad_right')
		
        @include('blocks.ad_head')
        @include('blocks.recommended')
        @include('blocks.video')
		
		@include('blocks.news')
	</div>

	<div class="sidebar2 sidebar--inverse">
		@include('blocks.torrents_torrents')
        @include('blocks.tops_torrents')
        @include('blocks.ad_center')
        @include('blocks.online')

		@include('blocks.ad_left')
	</div>
        @include('blocks.notification')
@endsection