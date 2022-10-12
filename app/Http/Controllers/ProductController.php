<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index($product_id)
    {
        $product = Product::find($product_id);

        return view('product', compact('product'));
    }

    public function search(Request $request)
    {
        $search = $request->q;

        return view('search', compact('search'));
    }
}
