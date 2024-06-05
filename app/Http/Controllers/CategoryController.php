<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index($category_id)
    {
        $category = Category::find($category_id);
        $products = Product::with('presentations')->where('category_id', $category_id)->where('availability', true)->paginate(20);

        // Save current url for back button
        session()->put('back_url', url()->current());

        return view('user.category', compact('category', 'products'));
    }
}
