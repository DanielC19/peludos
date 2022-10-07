<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ProductGrid extends Component
{
    use Product;

    public function render()
    {
        return view('livewire.product-grid');
    }
}
