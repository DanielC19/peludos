<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ProductView extends Component
{
    use Product;

    public function render()
    {
        return view('livewire.product-view');
    }
}
