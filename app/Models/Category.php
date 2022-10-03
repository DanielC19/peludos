<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'animal_id',
        'name',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }
}
