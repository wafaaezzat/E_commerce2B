<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
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
        $old_CartItems = Cart::where('user_id' , Auth::id())->get();
        foreach ($old_CartItems as $item)
        {
            if(!Product::where('id' , $item->product_id)->where('quantity' , '>=' , $item->product_quantity)->exists())
            {
                $removeItem = Cart::where('user_id' , Auth::id())->where('product_quantity' , $item->product_quantity)->first();
                $removeItem->delete();
            }
        }
        $cartItems = Cart::where('user_id' , Auth::id())->get();
        $news =  \App\Models\News::where('status' , 1)->where('Promo_Code' , '!=' , null)->first();
        return view('frontend.checkOut.index' , compact('cartItems' , 'news'));
    }

    public function PlaceOrder(Request $request)
    {
//        $cartItems = Cart::where('user_id', Auth::id())->get();
////        $cartItems->get();
//        foreach ($cartItems as $item)
//        {
//            $myArray = explode(',', $item->product_id);
//            $product_check = Product::where('id', $myArray )->get();  // check for exists product with this id
//        if ($product_check) {
//
//            $cartItems = Cart::where('user_id', Auth::id())->exists();
//            if ($cartItems) {

        $cartItems = Cart::where('user_id', Auth::id())->get();
//        $cartItems->all();
        foreach ($cartItems as $item)
        {
            $product_check = Product::where('id', $item->product_id)->first();  // check for exists product with this id
            if ($product_check) {

                $cartItems = Cart::where('user_id', Auth::id())->exists();
                if ($cartItems) {

                $order = new Order();
                $order->user_id = Auth::id();
                $order->fname = $request->fname;
                $order->lname = $request->lname;
                $order->email = $request->email;
                $order->phone = $request->phoneNumber;
                $order->address = $request->address;
//                $order->address2 = $request->address2;
                $order->city = $request->city;
                $order->state = $request->state;
                $order->country = $request->country;
                $order->pincode = $request->pinCode;
                $order->payment_mode = $request->payment_mode;
                $order->payment_id = $request->payment_id;
                $news = \App\Models\News::where('status', 1)->where('Promo_Code', $request->promocode)->first();
                if ($news) {
                    $order->Promo_Code = $request->promocode;

                } elseif (!$news) {
                    $order->Promo_Code = null;
                }
// to calculate total price
                    $total = 0;
                    $cartItem_total_price = Cart::where('user_id', Auth::id())->get();
                    foreach ($cartItem_total_price as $total_price) {
//                $total += $total_price->product->selling_price;
                        $total += $total_price->product->price * $total_price->product_quantity;
                        $news = \App\Models\News::where('status', 1)->latest()->first();

                        if ($news) {
                            if ($news->Promo_Code == $request->promocode) {
                                if ($news['%'] >= 1 && $news->LE == 0) {
                                    $TotalAfterDiscount = $total - (($news->discount * 100) / 100);
                                } elseif ($news->LE >= 1 && $news['%'] == 0) {
                                    $TotalAfterDiscount = $total - ($news->discount);
                                }
                                $order->discount = $news->discount;
                                $order->LE = $news->LE;
                                $order['%'] = $news['%'];
                            } else {
                                toastr()->error('Sorry Not found this promo code that you enter');
                                return redirect()->back();
                            }
                        }
                        else {
                            $TotalAfterDiscount = $total;
                        }
                        $order->total_price = $TotalAfterDiscount;
                    }
//            $order->total_price = $total;


                    $order->tracking_no = '3ds' . rand(1111, 9999);
                    $order->save();

                    $cartItems = Cart::where('user_id', Auth::id())->get();
                    foreach ($cartItems as $item) {

                        $orders = new OrderItems();
                        $orders->order_id = $order->id;
                        $orders->product_id = $item->product_id;
                        $orders->quantity = $item->product_quantity;
                        $orders->size = $item->size;

                        $num1 = $item->product->price;
                        $num2 = $item->product_quantity;
                        $multiplication = $num1 * $num2;

                        $price = $multiplication;
                        $news = \App\Models\News::where('status', 1)->where('Promo_Code', $request->promocode)->first();
                        if ($news) {
                            if ($news['%'] >= 1 && $news->LE == 0) {
                                $TotalAfterDiscount = ($price - (($news->discount / count($cartItems) * 100) / 100));
                            } elseif ($news->LE >= 1 && $news['%'] == 0) {
                                $TotalAfterDiscount = ($price - ($news->discount / count($cartItems)));
                            }
                        } else {
                            $TotalAfterDiscount = $price;
                        }
                        $orders->price = $TotalAfterDiscount;

//                        $orders->price = $multiplication;
                        $orders->save();


                        $product = Product::where('id', $item->product_id)->first();
                        $product->quantity = $product->quantity - $item->product_quantity; // لما اضيف كميه من منتج معين للاوردرات ينقص من الكميه الموجوده فالمنتج دا
                        $product->update();
                    }

//                    if (Auth::user()->address == null) //لو اليوزر دا مش عندي بيانات له قبل كدا يعني هو مطلبش اوردرا قبل كدا وجه طلب اوردر اهه احفظلي الداتا دي عنه
//                    {
                        $user = User::where('id', Auth::id())->first();
                            $user->name = $request->fname;
                            $user->lname = $request->lname;
                            $user->phone = $request->phoneNumber;
                            $user->address = $request->address;
//                            $user->address2 = $request->address2;
                            $user->city = $request->city;
                            $user->state = $request->state;
                            $user->country = $request->country;
                            $user->pincode = $request->pinCode;
                            $user->save();  // لو موجود وغيرت فالبيانات هيجدثها ولو مش موجود بيانات هيكريتها فال user
//                    }
                    $cartItems = Cart::where('user_id', Auth::id())->get();
                    Cart::destroy($cartItems); // امسحلي بقا الاوردر دا من السله عشان خلاص طلبته

                    if ($request->payment_mode == 'Paid by Razorpay' || $request->payment_mode == 'Paid by Paypal') {
//                return response()->json(['status' => 'Successfully Added your Order']);
                        return response()->json(toastr()->success(' Successfully Added your Order'));
                    }
                    else {

                            toastr()->success(' Successfully Added your Order');
                            return redirect()->back();


                    }
//                $order->Promo_Code = '';
//                $order->Promo_Code = '';
//
//                $order->discount = $news->discount;
//                $order->LE       = $news->LE;
//                $order['%']      = $news['%'];
//                } else {
//                    toastr()->error('Sorry Not found this promo code that you enter');
//                    return redirect()->back();
//                }
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

//    public function PlaceOrder(Request $request)
//    {
//
//        $cartItems = Cart::where('user_id', Auth::id())->exists();
//        if ($cartItems) {
//
//            $order = new Order();
//            $order->user_id  = Auth::id();
//            $order->fname     = $request->fname;
//            $order->lname    = $request->lname;
//            $order->email    = $request->email;
//            $order->phone    = $request->phoneNumber;
//            $order->address = $request->address;
//            $order->address2 = $request->address2;
//            $order->city     = $request->city;
//            $order->state    = $request->state;
//            $order->country  = $request->country;
//            $order->pincode  = $request->pinCode;
//            $order->payment_mode  = $request->payment_mode;
//            $order->payment_id  = $request->payment_id;
//            $news =  \App\Models\News::where('status' , 1)->where('Promo_Code' , $request->promocode)->first();
//            if($news) {
//                $order->Promo_Code = $request->promocode;
//
//            }
//            elseif(!$news) {
//                $order->Promo_Code = null;
//            }
//// to calculate total price
//                $total = 0;
//                $cartItem_total_price = Cart::where('user_id', Auth::id())->get();
//                foreach ($cartItem_total_price as $total_price){
////                $total += $total_price->product->selling_price;
//                    $total += $total_price->product->selling_price * $total_price->product_quantity;
//                    $news =  \App\Models\News::where('status' , 1)->where('Promo_Code' , $request->promocode)->first();
//                    if($news) {
//                        if ($news['%'] >= 1 && $news->LE == 0)
//                        {
//                            $TotalAfterDiscount = $total - (($news->discount * 100) / 100);
//                        }
//                        elseif ($news->LE >= 1 && $news['%'] == 0) {
//                            $TotalAfterDiscount = $total - ($news->discount);
//                        }
//                        $order->discount = $news->discount;
//                        $order->LE       = $news->LE;
//                        $order['%']      = $news['%'];
//                    }
//                    else{
//                        $TotalAfterDiscount = $total;
//                    }
//                }
////            $order->total_price = $total;
//                $order->total_price = $TotalAfterDiscount;
//
//                $order->tracking_no = '3ds' . rand(1111, 9999);
//                $order->save();
//
//                $cartItems = Cart::where('user_id', Auth::id())->get();
//                foreach ($cartItems as $item) {
//                    OrderItems::create([
//                        'order_id' => $order->id,
//                        'product_id' => $item->product_id,
//                        'quantity' => $item->product_quantity,
//                        'price' => $order->total_price,
//                    ]);
//
//                    $product = Product::where('id', $item->product_id)->first();
//                    $product->quantity = $product->quantity - $item->product_quantity; // لما اضيف كميه من منتج معين للسله ينقص من الكميه الموجوده فالمنتج دا
//                    $product->update();
//                }
//
//                if (Auth::user()->address == null) //لو اليوزر دا مش عندي بيانات له قبل كدا يعني هو مطلبش اوردرا قبل كدا وجه طلب اوردر اهه احفظلي الداتا دي عنه
//                {
//                    $user = User::where('id', Auth::id())->first();
//                    $user::update([
//                        'name'      => $request->fname,
//                        'lname'     => $request->lname,
//                        'phone'     => $request->phoneNumber,
//                        'address'  => $request->address,
//                        'address2'  => $request->address2,
//                        'city'      => $request->city,
//                        'state'     => $request->state,
//                        'country'   => $request->country,
//                        'pincode'   => $request->pinCode,
//                    ]);
//                }
//                $cartItems = Cart::where('user_id', Auth::id())->get();
//                Cart::destroy($cartItems); // امسحلي بقا الاوردر دا من السله عشان خلاص طلبته
//
//                if($request->payment_mode == 'Paid by Razorpay' || $request->payment_mode == 'Paid by Paypal')
//                {
////                return response()->json(['status' => 'Successfully Added your Order']);
//                    return response()->json(toastr()->success(' Successfully Added your Order'));
//                }
//
//                toastr()->success(' Successfully Added your Order');
//                return redirect()->back();
//
//
////                $order->Promo_Code = '';
////                $order->Promo_Code = '';
////
////                $order->discount = $news->discount;
////                $order->LE       = $news->LE;
////                $order['%']      = $news['%'];
////            }
////            else{
////                toastr()->error('Sorry Not found this promo code that you enter');
////                return redirect()->back();
////            }
//        }
//        else {
//            toastr()->error('Sorry Not found any Product in your cart to Order');
//            return redirect()->back();
//        }
//    }

// RazorpayCheck
    public function razorpayCheck(Request $request){
        $total_price = 0;
        $cartItems = Cart::where('user_id', Auth::id())->get();
        foreach ($cartItems as $item){
            $total_price += $item->product->price * $item->product_quantity;
        }

        $firstname = $request->input('firstname'); // input('firstname') => دا جاي من ملف ال checkout.js
        $lastname  = $request->input('lastname');
        $email     = $request->input('email');
        $phone     = $request->input('phone');
        $address  = $request->input('address');
//        $address2  = $request->input('address2');
        $city      = $request->input('city');
        $state     = $request->input('state');
        $country   = $request->input('country');
        $pincode   = $request->input('pincode');

        return response()->json([
             'firstname' => $firstname,  // 'firstname' => دا اي اسم افتراضي انا حاطه عادي وهكذا بقا مع كله
             'lastname'  => $lastname,
             'email'     => $email,
             'phone'     => $phone,
//             'address'  => $address,
             'address2'  => $address2,
             'city'      => $city,
             'state'     => $state,
             'country'   => $country,
             'pincode'   => $pincode,

            'total_price'=> $total_price,
        ]);

    }

}
