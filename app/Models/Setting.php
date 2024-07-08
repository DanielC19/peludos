<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    static $rules = [
        'shipment' => 'required',
        'rise' => 'required',
        'rise_not_logged' => 'required',
        'balance' => 'required',
    ];

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['shipment', 'rise', 'rise_not_logged', 'balance'];
}
