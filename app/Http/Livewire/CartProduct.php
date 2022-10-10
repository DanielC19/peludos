<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CartProduct extends Component
{
    public $product;
    public $amount;
    public $presentation;
    public $price;
    public $price_raw;

    /**
     * * Acts like constructor
     */
    public function mount()
    {    
        // Sets initial values for price and selected presentation
        foreach ($this->product->presentations as $item) {
            if ($item->id == $this->product->presentation) {
                $this->price = $item->price;
                $this->price_raw = $this->price;
                $this->presentation = $item->amount;
            }
        }
        // If there's already a change on the amount of products
        // takes it and updates price
        if (isset($this->product->amount)) {
            $this->amount = $this->product->amount;
            $this->price = $this->price_raw * $this->amount;
        } else {
            $this->amount = 1;    
        }
    }

    /**
     * * Renders the component
     */
    public function render()
    {
        return view('livewire.cart-product');
    }

    /**
     * * Increment amount of products
     * * and update price
     */
    public function increment()
    {
        $this->amount++;
        $this->price = $this->price_raw * $this->amount;

        // Updates value on session
        $products = [];
        foreach (session()->get('cart') as $product_cart) {
            if ($product_cart->id == $this->product->id) {
                $product_cart->amount = $this->amount;
            }
            array_push($products, $product_cart);
        }
        session()->put('cart', $products);
    }

    /**
     * * Reduce amount of products
     * * and update price
     */
    public function reduce()
    {
        $this->amount--;
        // Check it's not zero
        if ($this->amount == 0) {
            $this->amount = 1;
        }
        $this->price = $this->price_raw * $this->amount;

        // Updates value on session
        $products = [];
        foreach (session()->get('cart') as $product_cart) {
            if ($product_cart->id == $this->product->id) {
                $product_cart->amount = $this->amount;
            }
            array_push($products, $product_cart);
        }
        session()->put('cart', $products);
    }
}
