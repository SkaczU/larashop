<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $user = Auth::user();
    
        $orders = $user->orders()->paginate(10);
    
        return view('/profile/orders', ['orders' => $orders]);
    }
}
