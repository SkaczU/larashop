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
    //NIE ZAIMPLEMENTOWANO
    public function create()
    {
        return view('services.create');
    }

    //NIE ZAIMPLEMENTOWANO
    public function show(string $id)
    {
        $service = Service::findOrFail($id);
  
        return view('services.show', compact('service'));
    }

   //NIE ZAIMPLEMENTOWANO
    public function edit(string $id)
    {
        $service = Service::findOrFail($id);
  
        return view('services.edit', compact('service'));
    }

    //NIE ZAIMPLEMENTOWANO
    public function update(Request $request, string $id)
    {
     
        $service = Service::findOrFail($id);
  
        $service->update($request->all());
  
        return redirect()->route('services')->with('success', 'service updated successfully');
    }

    //NIE ZAIMPLEMENTOWANO
    public function destroy(string $id)
    {
        $service = Service::findOrFail($id);
  
        $service->delete();
  
        return redirect()->route('services')->with('success', 'services deleted successfully');
    }
}
