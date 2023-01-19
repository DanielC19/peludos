<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::with('presentations')->where('availability', true)->limit(20)->get();
        // Sets variable to don't try to paginate products in home view
        $home_view = true;

        // Save current url for back button
        session()->put('back_url', url()->current());

        return view('user.home', compact('products', 'home_view'));
    }
}
