<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Complaint;
use App\Models\Order;
use App\Models\Product;
use App\Models\Rating;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function view;

class FrontendController extends Controller
{

    public function __construct()
    {   // عشان احمي ان مش اي حد يقدر يخش علي الا م يسجل الاول
        $this->middleware('auth');
    }

    public function index()
    {
//        ->skip(10)->take(5)  بيتخطي اول 10 وبعد كدا يجيب اللي بعدهم

        $featured_categories = Category::take(15)->get(); // هيجبلك 15 بس
        $featured_products = Product::take(15)->get(); // هيجبلك 15 بس

        $product = Product::all()->pluck('category_id');
        $categories = Category::whereIn('id', $product)->get();

        $cat = Category::all()->pluck('id');
        $Products = Product::whereIn('category_id', $cat)->get();
        return view('frontend.index', compact('featured_products', 'featured_categories', 'Products', 'categories'));
    }


    public function category()
    {
        $featured_categories = Category::all(); // fetch all category
        return view('frontend.category', compact('featured_categories'));
    }


    public function ViewCategory($id)
    {
        if (Category::where('id', $id)->exists()) {
            $category = Category::where('id', $id)->first(); // fetch all category where id
//            note CategoryRequest may have same id with same category
            $products = Product::where('category_id', $category->id)->where('status', 1)->get(); // status' , 0) => يكون متوفر
            return view('frontend.products.index', compact('category', 'products'));
        } else {
            return redirect('/');
        }
    }


    public function ViewProduct($catid, $prodid)
    {
        if (Category::where('id', $catid)->exists()) {

            if (Product::where('id', $prodid)->exists()) {

                $product = Product::where('id', $prodid)->first(); // fetch all product where id


                return view('frontend.products.view', compact('product'));
            } else {
                return redirect('/');
            }
        } else {
            return redirect('/');
        }
    }

//   Search product in laravel | Ajax auto complete
    public function productListAjax()
    {
        $products = Product::select('name')->where('status', 0)->get();

        $data = [];

        foreach ($products as $item) {
            $data[] = $item['name'];
        }
        return $data;
    }

    public function searchProduct(Request $request)
    {
        $searched_product = $request->product_name;
        if ($searched_product != '') {
            $product = Product::where('name', "LIKE", "%$searched_product%")->first();
            if ($product) {
                return redirect('view-product/' . $product->category->id . '/' . $product->id);
            } else {
                toastr()->error('sorry, No product match your search');
                return redirect()->back();
            }
        } else {
            return redirect()->back();
        }

    }



}
