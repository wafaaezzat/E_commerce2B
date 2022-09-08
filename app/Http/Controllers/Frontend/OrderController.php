<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function __construct(){   // عشان احمي ان مش اي حد يقدر يخش علي الا م يسجل الاول
        $this->middleware('auth');
    }

    public function index()
    {
        $orders = OrderDetail::where('user_id' , Auth::id())->get();
        return view('frontend.orders.index' , compact('orders'));
    }


    public function view($id)
    {
        $myOrder = OrderDetail::where('id' , $id)->where('user_id' , Auth::id())->first();
        return view('frontend.orders.view' , compact('myOrder'));
    }

    public function deleteOrder($id)
    {
        if(Auth::check()) {
            if (OrderDetail::where('user_id', Auth::id())->exists())
                $myOrder = OrderDetail::where('user_id', Auth::id())->findOrFail($id)->first();
//            if($myOrder) {
                $myOrder->delete();
                toastr()->error('Successfully Deleted this Order');
                return redirect()->back();
//            }
//            else{
//                toastr()->error('Not Found this id of order');
//                return redirect()->back();
//            }
        }
        else{
            toastr()->error('please login to continue');
        }
    }

}
