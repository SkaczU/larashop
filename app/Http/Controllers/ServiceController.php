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

    public function addToCart($serviceId)
    {
        $service = Service::findOrFail($serviceId);

       \Cart::add($service->id, $service->name, $service->price, 1);

       return back();
    }
}
