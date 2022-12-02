@if($this->isBookmarked)
    <button wire:click="destroy({{ $torrent->id }})" class="btn btn-danger">
        <i class="{{ config('other.font-awesome') }} fa-bookmark"></i>
    </button>
@else
    <button wire:click="store({{ $torrent->id }})" class="btn btn-primary">
        <i class="{{ config('other.font-awesome') }} fa-bookmark"></i>
    </button>
@endif