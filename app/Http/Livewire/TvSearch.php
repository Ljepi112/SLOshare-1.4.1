<?php

namespace App\Http\Livewire;

use App\Models\Tv;
use Livewire\Component;
use Livewire\WithPagination;

class TvSearch extends Component
{
    use WithPagination;

    public $search;

    final public function paginationView(): string
    {
        return 'vendor.pagination.livewire-pagination';
    }

    final public function updatedPage(): void
    {
        $this->emit('paginationChanged');
    }

    final public function updatingSearch(): void
    {
        $this->resetPage();
    }

    final public function getShowsProperty(): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return Tv::with(['networks', 'genres'])
            ->withCount('seasons')
            ->when($this->search, fn ($query) => $query->where('name', 'LIKE', '%'.$this->search.'%'))
            ->oldest('name')
            ->paginate(30);
    }

    final public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return \view('livewire.tv-search', [
            'shows' => $this->shows,
        ]);
    }
}
