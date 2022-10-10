<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CartFixed extends Component
{
    public $counter;

    // Add listeners to update cart counter
    protected $listeners = ['productAdded' => 'update'];

    public function render()
    {
        $this->update();
        
        return view('livewire.cart-fixed');
    }

    public function update()
    {
        if (session()->has('cart')) {
            $this->counter = count(session()->get('cart'));
        } else {
            $this->counter = 0;
        }
    }
}
