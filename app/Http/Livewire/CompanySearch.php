<?php

namespace App\Http\Livewire;

use App\Models\Company;
use Livewire\Component;
use Livewire\WithPagination;

class CompanySearch extends Component
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

    final public function getCompaniesProperty(): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return Company::withCount('tv', 'movie', 'cartoon', 'cartoontv')
            ->where('name', 'LIKE', '%'.$this->search.'%')
            ->oldest('name')
            ->paginate(30);
    }

    final public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return \view('livewire.company-search', [
            'companies' => $this->companies,
        ]);
    }
}
