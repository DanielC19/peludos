<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class Search extends Component
{
    public $search;

    public function render()
    {
        $search = trim($this->search);

        return view('livewire.search', [
            'products' => Product::where(
                'name',
                'LIKE',
                '%'.$search.'%'
            )->get()
        ]);
    }
}
