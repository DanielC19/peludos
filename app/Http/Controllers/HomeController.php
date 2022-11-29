<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::limit(20)->get();
        // Sets variable to don't try to paginate products in home view
        $home_view = true;

        return view('user.home', compact('products', 'home_view'));
    }
}
