<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index($product_id)
    {
        $product = Product::find($product_id);
        // Sets variable to don't try to paginate products in home view
        $home_view = true;

        $products = Product::with('presentations')
                    ->where('category_id', $product->category_id)
                    ->inRandomOrder()
                    ->limit(6)
                    ->get();

        return view('user.product', compact('product', 'home_view', 'products'));
    }

    public function search(Request $request)
    {
        $search = $request->q;

        return view('user.search', compact('search'));
    }
}
