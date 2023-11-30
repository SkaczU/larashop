<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Service;
use App\QueryFilters\ServiceFilters;
use Darryldecode\Cart\Cart;
class ServiceController extends Controller
{
    public function index(ServiceFilters $filters)
    {

        $service =  Service::filterBy($filters)->paginate(10);
        return view('home')->with('service', $service);
    }

    public function addToCart(Request $request, $serviceId)
    {
        $service = Service::findOrFail($serviceId);
        $quantity = $request->input('quantity');

       \Cart::add($service->id, $service->name, $service->price, $quantity);

       return back()->with('success', 'Dodano ' . $service->name . ' do koszyka');

    }
}
