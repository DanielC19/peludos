<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Presentation extends Model
{ 
    static $rules = [
        'product_id' => 'required',
        'amount' => 'required',
        'price' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'product_id','amount','price', 'availability'];

    static public function generateId(): int
    {
        $number = mt_rand(1000000000, 9999999999);

        // call the same function if the id exists already
        if (Presentation::whereId($number)->exists()) {
            return Presentation::generateId();
        }

        // return id
        return $number;
    }

    public function toggleAvailability()
    {
        if ($this->availability) {
            $this->availability = false;
        } else {
            $this->availability = true;
        }
        $this->save();

        $product = Product::find($this->product_id);
        $presentations = $this->where('product_id', $this->product_id)->get();

        foreach ($presentations as $presentation) {
            if ($presentation->availability) {
                return;
            }
        }
        $product->toggleAvailability();
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
