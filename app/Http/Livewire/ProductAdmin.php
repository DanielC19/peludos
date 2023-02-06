<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductAdmin extends Component
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
        // Don't take into account white spaces
        $search = trim($this->search);

        return view('livewire.product-admin', [
            'products' => Product::with('category.animal')
                        ->where(
                            'id',
                            'LIKE',
                            $search . '%'
                        )->orWhere(
                            'name',
                            'LIKE',
                            '%' . $search . '%'
                        )->paginate(20)
        ])->with('i');
    }
}
