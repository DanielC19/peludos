<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

/**
 * Class AdminProductController
 * @package App\Http\Controllers
 */
class AdminProductController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('category')->paginate();

        return view('admin.product.index', compact('products'))
            ->with('i', (request()->input('page', 1) - 1) * $products->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $animals = Animal::all('id', 'name');
        return view('admin.product.create', compact('animals'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Product::$rules);

        $id = Product::generateId();

        Product::create([
            'id' => $id,
            'category_id' => $request->category_id,
            'name' => $request->name,
            'image' => $request->image,
            'availability' => true,
        ]);

        return redirect()->route('products.index')
            ->with('success', 'Producto creado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::with('presentations')->find($id);

        return view('admin.product.show', compact('product'))->with('i');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $animals = Animal::all('id', 'name');

        return view('admin.product.edit', compact('product', 'animals'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        request()->validate(Product::$rules);

        $product->update($request->all());

        return redirect()->route('products.index')
            ->with('success', 'Producto actualizado correctamente');
    }

    /**
     * @param int $id
     */
    public function toggleAvailability($id)
    {
        Product::find($id)->toggleAvailability();

        return redirect()->route('products.index')
            ->with('success', 'Disponibilidad de producto actualizada correctamente');
    }
}
