<?php

namespace App\Http\Controllers;

use App\Models\Presentation;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ApiController
{
    /**
     * Uploads products with image and presentation
     */
    public function uploadProduct(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'category_id' => 'required',
                'image' => 'required',
                'presentations' => 'required',
            ]);

            $product = Product::create([
                'id' => Product::generateId(),
                'category_id' => $request->category_id,
                'name' => $request->name,
                'image' => $request->image,
                'availability' => 1,
            ]);

            foreach ($request->presentations as $presentation) {
                Presentation::create([
                    'id' => Presentation::generateId(),
                    'product_id' => $product->id,
                    'amount' => $presentation['amount'],
                    'price' => $presentation['price'],
                    'availability' => 1,
                ]);
            }

            return response()->json(['message' => 'ok']);
        } catch (\Throwable $th) {
            return response()->json(['error' => true, 'message' => $th->getMessage()], 400);
        }
    }
}
