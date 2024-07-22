<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

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

        function determineRise() {
            if (Auth::user()) {
                if (Auth::user()->referred !== null) {
                    return Setting::find(1)->rise;
                }
            }
            return Setting::find(1)->rise_not_logged;
        }
        $rise = determineRise();

        foreach ($products as $product) {
            $product->price = round($product->presentation->price + ($product->presentation->price * ($rise / 100)), -2, PHP_ROUND_HALF_UP) * $product->amount;
            $total_price += $product->price;
            $total_amount += $product->amount;
        }

        // Get shipment cost and add it to total
        $shipment = Setting::find(1)->shipment;
        $total_price += $shipment;

        // Wompi Variables
        $reference_code = Order::generateReferenceCode($products);
        $amount_in_cents = $total_price * 100;
        $integrity_key = env('WOMPI_INTEGRITY_KEY');
        $public_key = env('WOMPI_PUBLIC_KEY');

        $signature = hash('sha256', $reference_code . $amount_in_cents . 'COP' . $integrity_key);

        $wompi = [
            'public_key' => $public_key,
            'integrity_signature' => $signature,
            'reference_code' => $reference_code,
            'amount_in_cents' => $amount_in_cents,
            'redirect_url' => route('pay.confirm'),
        ];

        return view('user.pay', compact('products', 'user', 'total_price', 'total_amount', 'wompi', 'shipment'));
    }

    /**
     * * Function that recieves response from PayU to generate payment
     * Confirmation URL
     */
    public function pay(Request $request)
    {
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
            if ($user->referred) {
                $referred_user = User::find($user->referred);
                $referred_user->balance += ($order->value * (Setting::find(1)->balance / 100));
            }
            $user->save();
        }
        // Save order with all data
        $order->save();

        return true;
    }

    /**
     * * Wompi redirects here to show final payment confirmation
     * Response URL
     */
    public function confirm(Request $request)
    {
        // Share that this is the cart view to not show fixed cart
        view()->share('cart_full_view', true);

        $wompi_private_key = env('WOMPI_PRIVATE_KEY');

        $wompi_response = Http::withToken($wompi_private_key)->get("https://sandbox.wompi.co/v1/transactions/$request->id");
        $wompi_response = $wompi_response->object();

        // Get order and all its products
        $order = Order::find($wompi_response->data->reference);
        $ordered_products = $order->products;

        // Add all items and its price
        $total_price = 0;
        $total_amount = 0;
        $products = [];
        
        function determineRise() {
            if (Auth::user()) {
                if (Auth::user()->referred !== null) {
                    return Setting::find(1)->rise;
                }
            }
            return Setting::find(1)->rise_not_logged;
        }
        $rise = determineRise();

        foreach ($ordered_products as $ordered_product) {
            $product = $ordered_product->presentation->product;
            $product->presentation = $ordered_product->presentation;
            $product->amount = $ordered_product->quantity;
            $product->price = round($product->presentation->price + ($product->presentation->price * ($rise / 100)), -2, PHP_ROUND_HALF_UP) * $product->amount;
            $total_price += $product->price;
            $total_amount += $product->amount;
            array_push($products, $product);
        }

        if ($order->transaction_id === null) {
            $date = explode('T', $wompi_response->data->finalized_at)[0];
            $time = explode('T', $wompi_response->data->finalized_at)[1];
            $time = explode('.', $time)[0];

            // Update Order with Wompi data
            $order->value = $wompi_response->data->amount_in_cents / 100;
            $order->state = $wompi_response->data->status;
            $order->transaction_id = $wompi_response->data->id;
            $order->transaction_date = "$date $time";
            $order->email = $wompi_response->data->customer_email;
            $order->cellphone = $wompi_response->data->shipping_address->phone_number;
            $order->address = $wompi_response->data->shipping_address->address_line_1;

            // If a registered user payed, save shipping info and its reference in the order
            $user = User::where('email', $wompi_response->data->customer_email)->first();
            if ($user !== null) {
                $order->user_id = $user->id;
                $user->cellphone = $wompi_response->data->shipping_address->phone_number;
                $user->address = $wompi_response->data->shipping_address->address_line_1;
                $user->save();
                if ($user->referred) {
                    $referred_user = User::find($user->referred);
                    $referred_user->balance += ($order->value * (Setting::find(1)->balance / 100));
                    $referred_user->save();
                }
            }
            // Save order with all data
            $order->save();
        }

        $shipping = Setting::find(1)->shipment;
        $total_price += $shipping;

        return view('user.confirm', compact('products', 'total_price', 'total_amount' ,'order', 'shipping'));
    }
}