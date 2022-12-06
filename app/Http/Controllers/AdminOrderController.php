<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends AdminController
{
    public function index()
    {
        $orders = Order::where('state', '!=', 'null')
                        ->orderBy('created_at')
                        ->paginate(20);

        $orders->map(function ($order) {
            if ($order->state == Order::APPROVED) {
                $order->status = 'Aprobado';
            } elseif ($order->state == Order::DECLINED) {
                $order->status = 'Cancelado';
            } elseif ($order->state == Order::PENDING) {
                $order->status = 'Pendiente';
            } elseif ($order->state == Order::ERROR) {
                $order->status = 'Error';
            } elseif ($order->state == Order::EXPIRED) {
                $order->status = 'Expirado';
            }
            return $order;
        });                        

        return view('admin.orders.index', compact('orders'))->with('i');
    }

    public function show($id)
    {
        $order = Order::find($id);
        if ($order->state == Order::APPROVED) {
            $order->status = 'Aprobado';
        } elseif ($order->state == Order::DECLINED) {
            $order->status = 'Cancelado';
        } elseif ($order->state == Order::PENDING) {
            $order->status = 'Pendiente';
        } elseif ($order->state == Order::ERROR) {
            $order->status = 'Error';
        } elseif ($order->state == Order::EXPIRED) {
            $order->status = 'Expirado';
        }

        return view('admin.orders.show', compact('order'))->with('i');
    }
}
