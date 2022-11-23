<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'state',
        'transaction_id',
        'value',
        'tax',
        'transaction_date',
        'user_id',
        'name',
        'email',
        'cellphone',
        'address',
    ];

    /**
     * Values that "state_pol" field returns from PayU
     * Used to know what it means on DB
     */
    CONST APPROVED = 4;
    CONST EXPIRED = 5;
    CONST DECLINED = 6;
    CONST PENDING = 7;
    CONST ERROR = 104;
    
    /**
     * Generates random and unique reference code,
     * also creates an Order with this number as ID
     */
    static public function generateReferenceCode(Array $products) : int
    {
        $number = mt_rand(1000000000, 9999999999);

        // call the same function if the reference code exists already
        if (Order::whereId($number)->exists()) {
            return Order::generateReferenceCode($products);
        }
        // otherwise, it's valid and can be used
        Order::create(['id' => $number]);

        // add products ordered to db
        foreach ($products as $product) {
            OrderedProduct::create([
                'order_id' => $number,
                'product_id' => $product->id
            ]);
        }

        // return referenco code
        return $number;
    }
}
