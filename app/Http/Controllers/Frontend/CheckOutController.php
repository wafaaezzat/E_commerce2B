<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderItem;
use App\Models\OrderItems;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckOutController extends Controller
{

    public function __construct(){   // عشان احمي ان مش اي حد يقدر يخش علي الا م يسجل الاول
        $this->middleware('auth');
    }

    public function index()
    {
        $old_CartItems = CartItem::where('user_id' , Auth::id())->get();
        foreach ($old_CartItems as $item)
        {
            if(!Product::where('id' , $item->product_id)->where('quantity' , '>=' , $item->quantity)->exists())
            {
                $removeItem = CartItem::where('user_id' , Auth::id())->where('product_quantity' , $item->quantity)->first();
                $removeItem->delete();
            }
        }
        $cartItems = CartItem::where('user_id' , Auth::id())->get();
        return view('frontend.checkOut.index' , compact('cartItems'));
    }

    public function PlaceOrder(Request $request)
    {

        $cartItems = CartItem::where('user_id', Auth::id())->get();
//        $cartItems->all();
        foreach ($cartItems as $item)
        {
            $product_check = Product::where('id', $item->product_id)->first();  // check for exists product with this id
            if ($product_check) {

                $cartItems = CartItem::where('user_id', Auth::id())->exists();
                if ($cartItems) {

                $order = new OrderDetail();
                $order->user_id = Auth::id();
                $order->payment_mode = $request->payment_mode;
                $order->payment_id = $request->payment_id;

// to calculate total price
                    $total = 0;
                    $cartItem_total_price = CartItem::where('user_id', Auth::id())->get();
                    foreach ($cartItem_total_price as $total_price) {
//                $total += $total_price->product->selling_price;
                        $total += $total_price->product->price * $total_price->quantity;

                            $TotalAfterDiscount = $total;

                        $order->total_price = $TotalAfterDiscount;
                    }
//            $order->total_price = $total;


                    $order->tracking_no = '3ds' . rand(1111, 9999);
                    $order->save();

                    $cartItems = CartItem::where('user_id', Auth::id())->get();
                    foreach ($cartItems as $item) {

                        $orders = new OrderItem();
                        $orders->order_id = $order->id;
                        $orders->product_id = $item->product_id;
                        $orders->quantity = $item->quantity;

                        $num1 = $item->product->price;
                        $num2 = $item->quantity;
                        $multiplication = $num1 * $num2;

                        $price = $multiplication;

                            $TotalAfterDiscount = $price;

                        $orders->price = $TotalAfterDiscount;

//                        $orders->price = $multiplication;
                        $orders->save();


                        $product = Product::where('id', $item->product_id)->first();
                        $product->quantity = $product->quantity - $item->quantity; // لما اضيف كميه من منتج معين للاوردرات ينقص من الكميه الموجوده فالمنتج دا
                        $product->update();
                    }

                    $cartItems = CartItem::where('user_id', Auth::id())->get();
                    CartItem::destroy($cartItems); // امسحلي بقا الاوردر دا من السله عشان خلاص طلبته

                    if ($request->payment_mode == 'Paid by Razorpay' || $request->payment_mode == 'Paid by Paypal') {
//                return response()->json(['status' => 'Successfully Added your Order']);
                        return response()->json(toastr()->success(' Successfully Added your Order'));
                    }
                    else {

                            toastr()->success(' Successfully Added your Order');
                            return redirect()->route('my-order');
                    }
            }
            else {
                toastr()->error('Sorry Not found any Product in your cart to Order');
                return redirect()->back();
            }
        } else {
            return response()->json(['status' => 'sorry Not found this product']);
        }
    }

    }

// RazorpayCheck
    public function razorpayCheck(Request $request){
        $total_price = 0;
        $cartItems = CartItem::where('user_id', Auth::id())->get();
        foreach ($cartItems as $item){
            $total_price += $item->product->price * $item->product_quantity;
        }

        $firstname = $request->input('firstname'); // input('firstname') => دا جاي من ملف ال checkout.js
        $lastname  = $request->input('lastname');
        $email     = $request->input('email');
        $phone     = $request->input('phone');
        $address  = $request->input('address');

        return response()->json([
             'firstname' => $firstname,  // 'firstname' => دا اي اسم افتراضي انا حاطه عادي وهكذا بقا مع كله
             'lastname'  => $lastname,
             'email'     => $email,
             'phone'     => $phone,
             'address'   => $address,
            'total_price'=> $total_price,
        ]);

    }

}
