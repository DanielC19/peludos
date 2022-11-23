<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class PayController extends Controller
{
    public function index()
    {
        // Validate its possible to show view
        if (session()->missing('cart') || count(session('cart')) == 0) {
            return redirect()->route('home');
        }

        // Share that this is the cart view to not show fixed cart
        view()->share('cart_full_view', true);

        // Take info of user and all products on cart
        $user = Auth::user();
        $products = session('cart');

        // Add all items and its price
        $total_price = 0;
        $total_amount = 0;
        foreach ($products as $product) {
            $product->price = $product->presentation->price * $product->amount;
            $total_price += $product->price;
            $total_amount += $product->amount;
        }

        // PayU Variables
        $reference_code = Order::generateReferenceCode($products);
        $account_id = Config::get('services.payu.account_id');
        $merchant_id = Config::get('services.payu.merchant_id');
        $api_key = Config::get('services.payu.api_key');
        $signature = md5("$api_key~$merchant_id~$reference_code~$total_price~COP");
        $payU = [
            'account_id' => $account_id,
            'merchant_id' => $merchant_id,
            'signature' => $signature,
            'reference_code' => $reference_code,
            'confirmation_url' => route('pay.response'),
            'response_url' => route('pay.confirm'),
        ];

        return view('pay', compact('products', 'user', 'total_price', 'total_amount', 'payU'));
    }
}