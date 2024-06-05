<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ProductView extends Component
{
    use Product;

    public function render()
    {
        $cached_url = session()->get('back_url');

        return view('livewire.product-view', compact('cached_url'));
    }
}
