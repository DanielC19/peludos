<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Cart extends Component
{
    public $counter;

    // Add listeners to update cart counter
    protected $listeners = ['productAdded' => 'update'];

    public function render()
    {
        if (session()->has('cart')) {
            $this->counter = count(session()->get('cart'));
        } else {
            $this->counter = 0;
        }
        return view('livewire.cart');
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
