<?php

namespace App\Http\Livewire;

use App\Models\Setting;
use Livewire\Component;

class CartProduct extends Component
{
    public $product;
    public $amount;
    public $price;
    public $presentation;

    /**
     * * Acts like constructor
     */
    public function mount()
    {
        // Sets initial values for price and selected presentation
        $rise = Setting::find(1)->rise;
        $this->price = round($this->product->presentation->price + ($this->product->presentation->price * ($rise / 100)), -2, PHP_ROUND_HALF_UP);
        $this->presentation = $this->product->presentation;

        // If there's already a change on the amount of products
        // takes it and updates price
        if (isset($this->product->amount)) {
            $this->amount = $this->product->amount;
            $this->price = round($this->product->presentation->price + ($this->product->presentation->price * ($rise / 100)), -2, PHP_ROUND_HALF_UP) * $this->amount;
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
        $this->price = $this->presentation->price * $this->amount;

        // Updates value on session
        $products = [];
        foreach (session()->get('cart') as $product_cart) {
            if ($product_cart->id == $this->product->id && $product_cart->presentation->id == $this->presentation->id) {
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
        $this->price = $this->presentation->price * $this->amount;

        // Updates value on session
        $products = [];
        foreach (session()->get('cart') as $product_cart) {
            if ($product_cart->id == $this->product->id && $product_cart->presentation->id == $this->presentation->id) {
                $product_cart->amount = $this->amount;
            }
            array_push($products, $product_cart);
        }
        session()->put('cart', $products);
    }
}
