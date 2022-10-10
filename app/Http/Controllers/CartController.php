<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(Request $request)
    {
        // Share that this is the cart view to not show fixed cart
        view()->share('cart_full_view', true);

        $products = session()->get('cart');

        if (session()->missing('cart')) {
            $products = [];
        }

        return view('cart', compact('products'));
    }

    /**
     * * Delete product from cart
     * Creates a new array storing all products on cart
     * that are NOT the product it's being deleted.
     * Then, store new array on session
     */
    public function delete($product_id)
    {
        $products = [];
        foreach (session()->get('cart') as $product_cart) {
            if ($product_cart->id != $product_id) {
                array_push($products, $product_cart);
            }
        }
        session()->put('cart', $products);

        return redirect()->route('cart');
    }
}
