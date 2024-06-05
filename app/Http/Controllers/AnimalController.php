<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Illuminate\Http\Request;

class AnimalController extends Controller
{
    public function index($animal_name)
    {
        $animals = Animal::with('categories')->where('name', $animal_name)->get();
        $animal = $animals[0];
        $products = Animal::products($animal->id);

        // Save current url for back button
        session()->put('back_url', url()->current());

        return view('user.animal', compact('products', 'animal'));
    }

    public function all()
    {
        $animals = Animal::all();

        return view('user.animals-all', compact('animals'));
    }
}
