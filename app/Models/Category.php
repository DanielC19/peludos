<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    
    static $rules = [
		'animal_id' => 'required',
		'name' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['animal_id','name'];


    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }
}
