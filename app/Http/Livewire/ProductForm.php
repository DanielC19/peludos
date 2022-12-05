<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;

class ProductForm extends Component
{
    public $product;
    public $animals;
    public $animal_id;
    public $categories;
    public $category_id;
    public $name;
    public $image;
    public $submit = false;

    protected $rules = [
        'animal_id' => 'required',
        'category_id' => 'required',
        'name' => 'required',
        'image' => 'required',
    ];

    public function mount()
    {
        if ($this->product !== null) {
            $this->animal_id = $this->product->category->animal->id;
            $this->category_id = $this->product->category->id;
            $this->name = $this->product->name;
            $this->image = $this->product->image;
            $this->categories = Category::where('animal_id', $this->animal_id)->get();
            $this->check();
        } else {
            $this->animal_id = $this->animals->first()->id;
            $this->animalUpdate();            
        }
    }

    public function render()
    {
        return view('admin.product.form');
    }

    public function check()
    {
        // validate all
        try {
            // Validate in a try/catch block to intercept the validation error.
            $this->validate();

            // If no exception was thrown, the form is valid, so we enable the button.
            $this->submit = true;
        } catch (\Exception $e) {
            // If the global validation failed, keep the button disabled.
            $this->submit = false;
        }
    }

    public function updated($propertyName)
    {
        // validate only field
        $this->validateOnly($propertyName);

        $this->check();
    }

    public function animalUpdate()
    {
        $this->categories = Category::where('animal_id', $this->animal_id)->get();
        if (null !== $this->categories->first()) {
            $this->category_id = $this->categories->first()->id;
        } else {
            $this->category_id = null;
        }

        $this->check();
    }
}
