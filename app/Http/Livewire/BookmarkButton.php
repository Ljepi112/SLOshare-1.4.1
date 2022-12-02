<?php

namespace App\Http\Livewire;

use App\Models\Torrent;
use Livewire\Component;

class BookmarkButton extends Component
{
    public $torrent;

    public ?\Illuminate\Contracts\Auth\Authenticatable $user = null;

    final public function mount($torrent): void
    {
        $this->user = \auth()->user();
        $this->torrent = Torrent::withAnyStatus()->findOrFail($torrent);
    }

    final public function getIsBookmarkedProperty(): int
    {
        return $this->torrent->bookmarked() ? 1 : 0;
    }

    final public function store(): void
    {
        if ($this->user->isBookmarked($this->torrent->id)) {
            $this->dispatchBrowserEvent('error', ['type' => 'error',  'message' => 'Torrent je že dodan med zaznamke!']);

            return;
        }

        $this->user->bookmarks()->attach($this->torrent->id);
        $this->dispatchBrowserEvent('success', ['type' => 'success',  'message' => 'Torrent je bil uspešno dodan med zaznamke!']);
    }

    final public function destroy(): void
    {
        $this->user->bookmarks()->detach($this->torrent->id);
        $this->dispatchBrowserEvent('success', ['type' => 'success',  'message' => 'Torrent je bil uspešno odstranjen iz zaznamkov!']);
    }

    final public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return \view('livewire.bookmark-button');
    }
}
