<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
   
    public function index(){

        $total = \Cart::getTotal();
        $cart = \Cart::getContent();
        
        return view('cart', compact('cart' , 'total'));
    }

    public function delete($id){

        \Cart::remove($id);

        return back();
    }


}
