<?php

namespace App\Http\Livewire;

use App\Models\Cartoon;
use Livewire\Component;
use Livewire\WithPagination;

class CartoonSearch extends Component
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

    final public function getCartoonsProperty(): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return Cartoon::query()
            ->with(['companies', 'genres'])
            ->when($this->search, fn ($query) => $query->where('title', 'LIKE', '%'.$this->search.'%'))
            ->oldest('title')
            ->paginate(30);
    }

    final public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return \view('livewire.cartoon-search', [
            'cartoons' => $this->cartoons,
        ]);
    }
}
