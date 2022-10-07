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
}