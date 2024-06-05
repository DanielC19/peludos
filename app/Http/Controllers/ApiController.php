<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class ApiController
{
    /**
     * Uploads product image, from scraping
     * returns image name to save in DB from scraping script
     */
    public function uploadImage(Request $request) : string
    {
        try {
            $timestamp = Carbon::now()->timestamp;
            $filename = "product_$timestamp.jpg";
            $image = $request->image->storeAs('uploads', $filename, 'public');            
            
            return json_encode([
                'res' => 'OK',
                'image' => $image
            ]);
        } catch (\Exception $e) {
            return json_encode([
                'res' => 'OK',
                'image' => $image
            ]);
        }
    }
}
