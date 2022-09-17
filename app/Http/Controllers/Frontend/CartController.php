<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CartRequest;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\Size;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{

    public function __construct(){   // عشان احمي ان مش اي حد يقدر يخش علي الا م يسجل الاول
        $this->middleware('auth');
    }


    public function addProduct(Request $request){

//        try {
//            $validator = $request->validated();


            $validator = Validator::make($request->all() , [
                'quantity'    => 'required',
            ],[
                'quantity.required'       => 'quantity of Product is required',
            ]);
//            if ($validator->fails()){
////                toastr()->error('عذرا البيانات التي ادخلتها غير صحيحه');
//            }

        $product_id = $request->product_id;
        $product_quantity = $request->product_quantity;
        if(Auth::check())
        {
            $product_check = Product::where('id' , $product_id)->first();  // check for exists product with this id
            if($product_check) {
                $product_check_quantity = $product_check->where('quantity', '>=', $product_quantity)->first();
                if ($product_check_quantity){
                    if (CartItem::where('product_id', $product_id)->where('user_id', Auth::id())->exists())//check for exists product with this id found in this user
                    {
//                    return response()->json(['status' => $product_check->name . ' Already this ProductRequest added to cart before']);
                        return response()->json(toastr()->error($product_check->name . ' Already  added to cart before'));

                    } else {
                        $cartItem = new CartItem();
                        $cartItem->user_id = auth()->user()->id;
                        $cartItem->product_id = $product_id;
                        $cartItem->quantity = $product_quantity;

                        $num1 = $product_check->price;
                        $num2 = $product_quantity;
                        $multiplication = $num1 * $num2;

                        $price = $multiplication;

                        $TotalAfterDiscount = $price;

                        $cartItem->price = $TotalAfterDiscount;

                        $cartItem->save();
//                    return response()->json(['status' => $product_check->name . ' success added to cart']);
                        return response()->json(toastr()->success($product_check->name . ' Successfully Added to your Cart'));

                    }
            }
                 else{
                     return response()->json(toastr()->error('sorry Not found this quantity for this product' ));
                 }
            }
            else{
                return response()->json(['status' =>'sorry Not found this product']);
            }
        }
        else{
            return response()->json(['status' =>'please login to continue']);
        }
//    }
//        catch (\Exception $e) {
//            return response()->json(toastr()->error('size of product is required' ));
//        }
    }


    public function viewCart()
    {
        $products = Product::all(); // fetch all product where slug
        foreach ($products as $product) {
        $cartItems = CartItem::where('user_id' , Auth::id())->get();  // simplePaginate(2)
            return view('frontend.cart.view', compact('cartItems', 'products'));
        }
    }


    public function updateCartItems(Request $request)
    {
        $product_id = $request->input('prod_id'); // prod_id => this extend from ajax data
        $product = Product::where('id', $product_id)->first();
        $productQuantity = $request->input('qty'); // qty => this extend from ajax data
        if (Auth::check()) {
            if (CartItem::where('product_id', $product_id)->where('user_id', Auth::id())->exists()) {
                $cartItem = CartItem::where('product_id', $product_id)->where('user_id', Auth::id())->first();
                $cartItem->quantity = $productQuantity;

                $num1 = $product->price;
                $num2 = $productQuantity;
                $multiplication = $num1 * $num2;

                $price = $multiplication;

                $TotalAfterDiscount = $price;

                $cartItem->price = $TotalAfterDiscount;

                $cartItem->update();
                return response()->json(toastr()->success(' Successfully Updated this Product from your Cart'));
            }
        }
    }


    public function deletecartItem(Request $request)
    {
        if(Auth::check()) {
            $product_id = $request->input('prod_id'); // prod_id => this extend from ajax data
            if (CartItem::where('product_id', $product_id)->where('user_id', Auth::id())->exists())
                $cartItem = CartItem::where('product_id', $product_id)->where('user_id', Auth::id())->first();
                $cartItem->delete();

            return response()->json(toastr()->error(' Successfully Deleted this ProductRequest from your Cart'));

        }
        else{
            return response()->json(['status' =>'please login to continue']);
        }
    }

    public function cartCount(){
        if(Auth::check()) {
            if (CartItem::where('user_id', Auth::id())->exists())
               $cartCount = CartItem::where('user_id', Auth::id())->count();
            return response()->json(['count' => $cartCount]);

        }
        else{
            return response()->json(['status' =>'please login to continue']);
        }
    }

}
