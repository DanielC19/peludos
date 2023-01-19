<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Search extends Component
{
    use WithPagination;

    public $search;

    // Speficies to use bootstrap theme on pagination
    protected $paginationTheme = 'bootstrap';

    /**
     * Resets pagination to 1 when search input is updated
     */
    public function updatingSearch()
    {
        $this->resetPage();
    }

    /**
     * * Renders the component
     * Searching for the query in search input
     * also paginates
     */
    public function render()
    {
        // Save current url for back button
        session()->put('back_url', url()->current());
        
        // Don't take into account white spaces
        $search = trim($this->search);

        return view('livewire.search', [
            'products' => Product::with('presentations')
                                ->where('availability', true)
                                ->where(
                                    'name',
                                    'LIKE',
                                    '%'.$search.'%'
                                )->paginate(20)
        ]);
    }
}
