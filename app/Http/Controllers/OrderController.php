<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Order_item;

class OrderController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $orders = $user->orders()->paginate(10);
    
        return view('profile.orders', ['orders' => $orders]);
    }

    public function showServices($orderId)
    {
        $user = Auth::user();

        $order = Order::with('order_items.service')->where('id', $orderId)->first();

        if (!$order || $order->user_id !== $user->id) {
            return redirect('/home')->with('error', 'Brak dostępu do tego zamówienia.');
        }


        return view('profile.services', [
            'order' =>$order,
        ]);
    }


    public function showMyServices($orderId)
    {
        $user = Auth::user();
        $order = Order::with('order_items.service')->where('id', $orderId)->first();

        if (!$order || $order->user_id !== $user->id) {
        return redirect('/home')->with('error', 'Brak dostępu do tego zamówienia.');
        }


        return view('profile.myservices', [
            'order' =>$order,
        ]);
    }


}

