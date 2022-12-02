<button wire:click="store({{ $torrent->id }})" class="btn btn-xl btn-primary">
    <i class="{{ config('other.font-awesome') }} fa-heart text-pink"></i> {{ __('torrent.thank') }}
    ({{ $torrent->thanks()->count() }})
</button>