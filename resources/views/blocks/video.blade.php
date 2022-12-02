	<section class="panelV2">
		<div class="video-container">
		@foreach ($clients as $client)
            <iframe width="830px" height="374px" src="https://www.youtube.com/embed/{{ $client->link }}"></iframe>
        @endforeach
		</div>
	</section>
</div>