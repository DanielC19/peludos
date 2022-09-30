<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Illuminate\Http\Request;

class AnimalController extends Controller
{
    public function index($animal_name)
    {
        $animals = Animal::all()->where('name', $animal_name)->take(1);
        foreach ($animals as $value) {
            $animal = $value;
        }
        $products = Animal::products($animal->id);
        return view('animal', compact('products', 'animal'));
    }
}
