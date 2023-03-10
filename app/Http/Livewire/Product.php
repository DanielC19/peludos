<?php

namespace App\Http\Livewire;

use App\Models\Presentation;
use App\Models\Setting;

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
        $rise = Setting::find(1)->rise;
        foreach ($this->product->presentations as $presentation) {
            if ($presentation->availability) {
                $this->presentation_selected = $presentation->id;
                $this->price = round($presentation->price + ($presentation->price * ($rise/100)), -2, PHP_ROUND_HALF_UP);
                break;
            }
        }

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
        $rise = Setting::find(1)->rise;
        $this->presentation_selected = $presentation_id;
        $this->price = round(Presentation::find($presentation_id)->price + (Presentation::find($presentation_id)->price * ($rise / 100)), -2, PHP_ROUND_HALF_UP);

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
        if (!$this->product->availability) {
            // Change cart button message
            $this->cart_msg = "Producto Agotado";
            return;
        }

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
                    if (!$presentation->availability) {
                        // Change cart button message
                        $this->cart_msg = "Presentación Agotada";
                        return;
                    }
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

    /**
     * * Option to fast buy one article
     * Deletes all products on cart and redirects to pay view
     */
    public function buyFast()
    {
        if (!$this->product->availability) {
            // Change cart button message
            $this->cart_msg = "Producto Agotado";
            return;
        }

        // Empty cart (or create it)
        session()->put('cart', []);
        // Add this product to cart
        $this->addCart();

        // Redirect to pay
        redirect()->route('pay');
    }
}