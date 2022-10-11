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
        $products = Product::where('category_id', $category_id)->paginate(20);

        return view('category', compact('category', 'products'));
    }
}
