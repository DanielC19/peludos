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

    /**
     * * Function that recieves response from PayU to generate payment
     * Confirmation URL
     */
    public function pay(Request $request)
    {
        // TODO: Cast reference to int
        // Find the order by its reference_code
        $order = Order::find($request->reference_sale);
        if ($order === null) {
            Order::create(['id' => $request->reference_sale]);
            $order = Order::find($request->reference_sale);
        }
        // Save each field of the response ir the order
        $order->state = $request->state_pol;
        $order->transaction_id = $request->transaction_id;
        $order->value = $request->value;
        $order->tax = $request->tax;
        $order->transaction_date = $request->transaction_date;
        $order->email = $request->email_buyer;
        $order->cellphone = $request->phone;
        $order->address = $request->shipping_address;
        // If a registered user payed, save shipping info and its reference in the order
        $user = User::where('email', $request->email_buyer)->first();
        if ($user !== null) {
            $order->user_id = $user->id;
            $user->cellphone = $request->phone;                
            $user->address = $request->shipping_address;                
            $user->save();
        }
        // Save order with all data
        $order->save();
        
        session()->put('cart', []);

        return true;
    }
}