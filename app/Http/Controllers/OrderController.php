<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use App\Models\Service;
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

    public function myServices($serviceId)
{
    $user = Auth::user();

    $viewPath = resource_path("views/services/$serviceId.blade.php");
    if (!File::exists($viewPath)) {
        return redirect('/home')->with('error', 'Brak dostępu do tego zamówienia.');
    }

    $service = Service::findOrFail($serviceId);

    $orderItems = Order_Item::where('service_id', $serviceId)
        ->whereHas('order', function ($query) use ($user) {
            $query->where('user_id', $user->id)
                ->where('status', 'Zakonczone');
        })
        ->where(function ($query) {
            $query->where(function ($q) {
                    $q->whereDate('start_date', '<=', Carbon::now())
                        ->whereDate('end_date', '>=', Carbon::now());
                })
                ->orWhere(function ($q) {
                    $q->whereNull('start_date')
                        ->whereNull('end_date');
                });
        })
        ->latest('end_date')
        ->get();

    return view("services.$serviceId", [
        'service' => $service,
        'orderItems' => $orderItems,
    ]);
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

    public function showMyServices()
    {
        $user = Auth::user();
        $services = Order_Item::select('service_id', DB::raw('GROUP_CONCAT(id) as order_item_ids'), DB::raw('MAX(start_date) as start_date'), DB::raw('MAX(end_date) as end_date'))
        ->with(['service'])
        ->whereHas('order', function ($query) use ($user) {
            $query->where('user_id', $user->id)
                  ->where('status', 'Zakonczone');
        })
        ->where(function ($query) {
            $query->where(function ($q) {
                    $q->whereDate('start_date', '<=', Carbon::now())
                        ->whereDate('end_date', '>=', Carbon::now());
                })
                ->orWhere(function ($q) {
                    $q->whereNull('start_date')
                        ->whereNull('end_date');
                });
        })
        ->groupBy('service_id')
        ->latest('end_date')
        ->get();
        
        return view('profile.myservices', [
            'services' => $services,
        ]);
    }
}