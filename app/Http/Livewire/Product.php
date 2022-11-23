<?php

namespace App\Http\Livewire;

use App\Models\Presentation;

trait Product 
{
    public $product;
    public $presentation_selected;
    public $price;
    public $cart_msg = "Añadir al carrito";

    /**
     * * Acts like constructor
     * Sets initial values for price and selected presentation
     */
    public function mount()
    {
        $this->presentation_selected = $this->product->presentations[0]->id;
        $this->price = $this->product->presentations[0]->price;

        // If product is on cart, change cart button msg
        if (session()->has('cart')) {
            foreach (session()->get('cart') as $product) {
                if ($product->id == $this->product->id && $product->presentation->id == $this->presentation_selected) {
                    $this->cart_msg = "¡Añadido al carrito!";
                }
            }
        }
    }

    /**
     * * Highlight a given presentation button 
     */
    public function selectPresentation($presentation_id)
    {
        $this->presentation_selected = $presentation_id;
        $this->price = Presentation::find($presentation_id)->price;

        // If product is on cart, change cart button msg
        if (session()->has('cart')) {
            foreach (session()->get('cart') as $product) {
                if ($product->id == $this->product->id && $product->presentation->id == $this->presentation_selected) {
                    $this->cart_msg = "¡Añadido al carrito!";
                    break;
                } else {
                    $this->cart_msg = "Añadir al carrito";                    
                }
            }
        }
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

        // Check this product isn't already on cart
        $add_product = true;
        foreach (session()->get('cart') as $product) {
            if ($this->product->id == $product->id && $product->presentation->id == $this->presentation_selected) {
                $add_product = false;
            }
        }
        
        if ($add_product) {
            // Assign selected presentation to product
            foreach ($this->product->presentations as $presentation) {
                if ($this->presentation_selected == $presentation->id) {
                    $this->product->presentation = $presentation;
                }
            }
            // Asign default amount of products
            if ($this->product->amount == null) {
                $this->product->amount = 1;
            }

            // Add product to cart
            session()->push('cart', $this->product);
        }

        // Change cart button message
        $this->cart_msg = "¡Añadido al carrito!";

        // Emit an event to increment cart counter
        $this->emit('productAdded');
    }
}