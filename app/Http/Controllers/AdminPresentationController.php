<?php

namespace App\Http\Controllers;

use App\Models\Presentation;
use App\Models\Product;
use Illuminate\Http\Request;

/**
 * Class PresentationController
 * @package App\Http\Controllers
 */
class AdminPresentationController extends AdminController
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($product_id)
    {
        $presentation = new Presentation();
        return view('admin.presentation.create', compact('presentation', 'product_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Presentation::$rules);

        $price = filter_var($request->price, FILTER_SANITIZE_NUMBER_INT);
        $id = Product::generateId();

        $presentation = Presentation::create([
            'id' => $id,
            'product_id' => $request->product_id,
            'amount' => $request->amount,
            'price' => $price,
            'availability' => true,
        ]);

        return redirect()->route('products.show', $presentation->product->id)
            ->with('success', 'Presentación creada correctamente.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $presentation = Presentation::find($id);

        return view('admin.presentation.edit', compact('presentation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Presentation $presentation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        request()->validate(Presentation::$rules);

        $price = filter_var($request->price, FILTER_SANITIZE_NUMBER_INT);

        $presentation = Presentation::find($request->id);

        $presentation->update([
            'amount' => $request->amount,
            'price' => $price,
        ]);

        return redirect()->route('products.show', $presentation->product->id)
            ->with('success', 'Presentación actualizada correctamente');
    }

    /**
     * @param int $id
     */
    public function toggleAvailability($id)
    {
        $presentation = Presentation::find($id);
        $presentation->toggleAvailability();

        return redirect()->route('products.show', $presentation->product->id)
            ->with('success', 'Disponibilidad de presentación actualizada correctamente');
    }
}
