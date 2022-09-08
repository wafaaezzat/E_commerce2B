<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function __construct(){   // عشان احمي ان مش اي حد يقدر يخش علي الا م يسجل الاول
        $this->middleware('auth');
    }

    public function index()
    {
        $newOrders = OrderDetail::where('status' , '0')->get();
        return view('admin.pages.orders.index' , compact('newOrders'));

    }


    public function show($id)
    {
        $Order = OrderDetail::where('id' , $id)->first();
        return view('admin.pages.orders.view' , compact('Order'));

    }


    public function update(Request $request, $id)
    {
        $order = OrderDetail::find($id);
        $order->status = $request->status;
        $order->update();
        toastr()->success($order->name .' Successfully Updated This Order');
        return redirect()->route('orders.index');
    }

    public function ordersHistory()
    {
        $ordersHistory = OrderDetail::where('status' , '1')->get();
        return view('admin.pages.orders.history' , compact('ordersHistory'));

    }

}
