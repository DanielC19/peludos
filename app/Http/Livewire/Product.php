<?php

namespace App\Http\Livewire;

use App\Models\Presentation;

trait Product 
{
    public $product;
    public $presentation_selected;
    public $price;

    /**
     * * Acts like constructor
     * Sets initial values for price and selected presentation
     */
    public function mount()
    {
        $this->presentation_selected = $this->product->presentations[0]->id;
        $this->price = $this->product->presentations[0]->price;
    }

    /**
     * * Highlight a given presentation button 
     */
    public function selectPresentation($presentation_id)
    {
        $this->presentation_selected = $presentation_id;
        $this->price = Presentation::find($presentation_id)->price;
    }

    /**
     * * Add product with selected presentation to cart
     */
    public function addCart()
    {
        // If there's nothing, create empty cart
        if (session()->missing('cart')) {
            session()->put('cart', []);
        }

        // Assign selected presentation to product}
        $this->product->presentation = $this->presentation_selected;

        // Check this product isn't already on cart
        $add_product = true;
        foreach (session()->get('cart') as $product) {
            if ($this->product->id == $product->id) {
                $add_product = false;
            }
        }
        if ($add_product) {
            // Add product to cart
            session()->push('cart', $this->product);
        }

        // Emit an event to increment cart counter
        $this->emit('productAdded');
    }
}