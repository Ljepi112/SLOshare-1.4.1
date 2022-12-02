<?php

namespace App\Http\Livewire;

use App\Models\Collection;
use Livewire\Component;
use Livewire\WithPagination;

class CollectionSearch extends Component
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

    final public function getCollectionsProperty(): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return Collection::withCount('movie')
            ->with('movie')
            ->where('name', 'LIKE', '%'.$this->search.'%')
            ->oldest('name')
            ->paginate(25);

        return Collection::withCount('cartoon')
            ->with('cartoon')
            ->where('name', 'LIKE', '%'.$this->search.'%')
            ->oldest('name')
            ->paginate(25);
    }

    final public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return \view('livewire.collection-search', [
            'collections' => $this->collections,
        ]);
    }
}
