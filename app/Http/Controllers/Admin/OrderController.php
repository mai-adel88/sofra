<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Order;


class OrderController extends Controller
{
    public function index()
    {
    	$orders= Order::paginate(4);       
    	return view('admin.orders.index', compact('orders'));
    }

    public function show(Request $request, $id)
    {
    	$order = Order::findOrFail($id);
         //dd($order);
    	return view('admin.orders.show', compact('order'));
    }

}
