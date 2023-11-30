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
use Illuminate\Support\Facades\Http;


class OrderController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $orders = $user->orders()->paginate(10);
    
        return view('profile.orders', ['orders' => $orders]);
    }

    public function store(Request $request, )
    {

    $cart = \Cart::getContent();
    $total_price = \Cart::getTotal();

    $order = new Order();

    $order->user_id = auth()->user()->id;
    $order->value = $total_price;
    $order->save();

    $carbonObject = Carbon::createFromFormat('Y-m-d', $request->input('startDate'));
    $startDate = $carbonObject->startOfDay();
   
    foreach ($cart as $item){
    
    $endDate = $startDate->copy()->addMonths($item->quantity);

    $order->order_items()->create([
        'service_id' => $item->id,
        'quantity' =>$item->quantity,
        'start_date' => $startDate,
        'end_date' => $endDate,
    ]);
    }

    \Cart::clear();

    return redirect('/profile/orders')->with('success', 'Złożono zamówienie');

    }


    public function myServices($serviceId)
{
    $user = Auth::user();

    $viewPath = resource_path("views/services/$serviceId.blade.php");
    if (!File::exists($viewPath)) {
        return redirect('services.noservice')->with('error', 'Brak dostępu do tego zamówienia.');
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

        $response = Http::get('https://dev.edwin.pcss.pl/api/meteo/v3/observationStation?type=WEATHER&active=true&page=0&size=50');

        if ($response->successful()) {
            $content = $response->json();
        } else {
            $content = $response->status();
            //return response()->json(['message' => 'Error: ' . $statusCode], $statusCode);
        }

        return view("services.$serviceId", [
        'service' => $service,
        'orderItems' => $orderItems,
        'data' => $content,
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

    public function noService()
    {
        $user = Auth::user();
    
        return view('services.noservice');
    }
}