<?php

namespace App\Http\Livewire;

use App\Models\Thank;
use App\Models\Torrent;
use Livewire\Component;

class ThankButton extends Component
{
    public $torrent;

    public ?\Illuminate\Contracts\Auth\Authenticatable $user = null;

    final public function mount($torrent): void
    {
        $this->user = \auth()->user();
        $this->torrent = Torrent::withAnyStatus()->findOrFail($torrent);
    }

    final public function store(): void
    {
        if ($this->user->id === $this->torrent->user_id) {
            $this->dispatchBrowserEvent('error', ['type' => 'error',  'message' => 'Svoji lastni vsebini se ne morete zahvaliti!']);

            return;
        }

        $thank = Thank::where('user_id', '=', $this->user->id)->where('torrent_id', '=', $this->torrent->id)->first();
        if ($thank) {
            $this->dispatchBrowserEvent('error', ['type' => 'error',  'message' => 'Ste se že zahvalili!']);

            return;
        }

        $thank = new Thank();
        $thank->user_id = $this->user->id;
        $thank->torrent_id = $this->torrent->id;
        $thank->save();

        //Notification
        if ($this->user->id !== $this->torrent->user_id) {
            $this->torrent->notifyUploader('thank', $thank);
        }

        $this->dispatchBrowserEvent('success', ['type' => 'success',  'message' => 'Vaša zahvala je bila uspešno poslana!']);
    }

    final public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return \view('livewire.thank-button');
    }
}
