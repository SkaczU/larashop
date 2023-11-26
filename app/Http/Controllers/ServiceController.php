<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Service;
use App\QueryFilters\ServiceFilters;
class ServiceController extends Controller
{
    public function index(ServiceFilters $filters)
    {

        $service =  Service::filterBy($filters)->paginate(10);


        return view('home')->with('service', $service);
    }

    public function addToCart($productId)
    {
        $service = Service::findOrFail($productId);
        dd('add_to_cart');
    }
}
