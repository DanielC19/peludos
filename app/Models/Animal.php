<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Animal extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'image'
    ];

    static public function products($animal_id)
    {
        $products_db = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('animals', 'categories.animal_id', '=', 'animals.id')
            ->where('animals.id', '=', $animal_id)
            ->orderByRaw('RAND()')
            ->limit(20)
            ->get(['products.id']);
        // dd($products_db);
        $products = [];
        foreach ($products_db as $product) {
            $products[] = Product::find($product->id);
        }
        return $products;
    }
    
    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}
