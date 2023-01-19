<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    
    static $rules = [
		'category_id' => 'required',
		'name' => 'required',
		'image' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'category_id','name','image', 'availability'];

    static public function generateId() : int
    {
        $number = mt_rand(1000000000, 9999999999);

        // call the same function if the id exists already
        if (Product::whereId($number)->exists()) {
            return Product::generateId();
        }

        // return id
        return $number;
    }

    public function toggleAvailability()
    {
        $is_available = false;
        foreach ($this->presentations as $presentation) {
            if ($presentation->availability) {
                $is_available = true;
            }
        }
        if (!$is_available) {
            $this->availability = false;
            $this->save();
            return;
        }

        if ($this->availability) {
            $this->availability = false;
        } else {
            $this->availability = true;
        }
        $this->save();
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    public function presentations()
    {
        return $this->hasMany(Presentation::class)->orderBy('amount');
    }
}
