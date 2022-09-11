<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use function view;

class ProductController extends Controller
{

    public function __construct()
    {   // عشان احمي ان مش اي حد يقدر يخش علي الا م يسجل الاول
        $this->middleware('auth');
    }


    public function index()
    {
        $products = Product::all();
        return view('admin.pages.Products.index', compact('products'));
    }


    public function create()
    {
        $categories = Category::all();
        return view('admin.pages.Products.add', compact('categories' ));
    }


    public function store(ProductRequest $request)
    {
//        dd($request->images); die();

        try {
            $validator = $request->validated();

            if (!$validator){
                toastr()->error('عذرا البيانات التي ادخلتها غير صحيحه');
                return redirect()->route('products.create')->withErrors($validator)->withInput();
            }
//banner image
            if($request->hasFile('banner_image')) {
                $banner_image = $request->banner_image;
                $newBannerImage = time() . $banner_image->getClientOriginalName(); // getClientOriginalName بيفصلي ام الصوره عن الامتداد بتاعها
//  time() => عشان يكريتلي رقم عشوائي قبل اسم الصوه عشان لو الصوره اتكررت ترتفع عادي بس اسمها هيختلف عشان الرقم العشوائي دا
                $banner_image->move(public_path('uploads/Products/BannerImage/' . $request->name ), $newBannerImage);
            }

            if ($request->hasFile('images')) {
                $photos = $request->images;
                foreach ($photos as $photo) {

                    $allowedfileExtension = ['jpg', 'png'];
                    $filename = $photo->getClientOriginalName();
                    $extension = $photo->getClientOriginalExtension();
                    $check = in_array($extension, $allowedfileExtension);
                    if ($check) {
                        $photo->move(public_path('uploads/Products/' . $request->name), $filename);
                    }
                }
            }

            $product = new Product();
                $product->category_id = $request->category_id;
                $product->name = $request->name;
                $product->banner_image = 'uploads/Products/BannerImage/' . $request->name . '/'. $newBannerImage;
                $product->desc = $request->desc;
                $product->price = $request->price;
                $product->quantity = $request->quantity;
                $product->status = $request->input('status') == True ? '1' : '0';
                $product->trending = $request->input('trending') == True ? '1' : '0';
                $product->created_by = auth()->user()->id; // Auth::id()
                $product->last_modified_user = auth()->user()->id;

                $product->save();

            $my_product = Product::where('id' , $product->id)->first();

            if ($request->hasFile('images')) {
                $photos = $request->images;
                foreach ($photos as $photo) {
                    $allowedfileExtension = ['jpg', 'png'];
                    $filename = $photo->getClientOriginalName();
                    $extension = $photo->getClientOriginalExtension();
                    $check = in_array($extension, $allowedfileExtension);
                    if ($check) {
                        $product_images = new Image();
                        $product_images->product_id = $my_product->id;
                        $product_images->image = 'uploads/Products/' . $my_product->name . '/' . $filename;
                        $product_images->save();
                    }
                }
            }

            toastr()->success('Successfully Created Products');
            return redirect()->back();
        }
        catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }

    }


    public function edit($id)
    {
        $categories = Category::all();
        $product = Product::where('id', $id)->first();
        return view('admin.pages.Products.edit', compact( 'product', 'categories'));
    }


    public function update(ProductRequest $request, $id)
    {

        $product = Product::where('id', $id)->first();
        $product_images = Image::where('product_id' , $product->id)->get();


        if($request->hasFile('banner_image')) {

            $banner_image_path = $product->banner_image;
            if(File::exists($banner_image_path)) {
                File::delete($banner_image_path); // delete path from public uploads
            }
            $banner_image = $request->file('banner_image');
            $newBannerImage = time() . $banner_image->getClientOriginalName(); // getClientOriginalName بيفصلي ام الصوره عن الامتداد بتاعها
//  time() => عشان يكريتلي رقم عشوائي قبل اسم الصوه عشان لو الصوره اتكررت ترتفع عادي بس اسمها هيختلف عشان الرقم العشوائي دا
            $banner_image->move(public_path('uploads/Products/BannerImage/' . $request->id), $newBannerImage); // put photo in filed in public uploads

            // هحط تعديل الصوره هنا عشان لو مفيش صوره يحط القديمه زي م هي وميطلعش اي ايررور بس كدا
            $product->banner_image = 'uploads/Products/BannerImage/' . $request->id . '/'. $newBannerImage;  // $file_name => هي اسم الصوره بدون امتداد
        }

        if (isset($product_images)) {
//   delete folder of images from public
            $folder = $product->name;
            $folder_by_id = $product->id;
            $path_folder = 'uploads/Products/';
            if (File::exists($path_folder . $folder)) {
                File::deleteDirectory($path_folder . $folder); // delete path from public uploads
            } else if (File::exists($path_folder . $folder_by_id)) {
                File::deleteDirectory($path_folder . $folder_by_id);
            }
        }

        $validator = $request->validated();

        if (!$validator){
            toastr()->error('عذرا البيانات التي ادخلتها غير صحيحه');
            return redirect()->route('products.edit')->withErrors($validator)->withInput();
        }

            if ($request->hasFile('images')) {
                $photos = $request->images;
            foreach ($photos as $photo) {
                $allowedfileExtension = ['jpeg','png','jpg'];
                $filename = $photo->getClientOriginalName();
                $extension = $photo->getClientOriginalExtension();
                $check = in_array($extension, $allowedfileExtension);
                if ($check) {
                    $photo->move(public_path('uploads/Products/' . $request->id), $filename);
                }
            }
        }

        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->desc = $request->desc;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->status = $request->input('status') == True ? '1' : '0';
        $product->trending = $request->input('trending') == True ? '1' : '0';

        $product->update();

        $my_product = Product::where('id' , $product->id)->first();
        $product_images = Image::where('product_id' , $product->id)->get();

        if (isset($product_images)) {
//    delete images from database
            foreach ($product_images as $product_image) {
                $product_image->delete();
            }
        }

            if ($request->hasFile('images')) {
                $photos = $request->images;
                foreach ($photos as $photo) {
                    $allowedfileExtension = ['jpeg','png','jpg'];
                    $filename = $photo->getClientOriginalName();
                    $extension = $photo->getClientOriginalExtension();
                    $check = in_array($extension, $allowedfileExtension);
                    if ($check) {
                        $product_images = new Image();
                        $product_images->product_id = $my_product->id;
                        $product_images->image = 'uploads/Products/' . $my_product->id . '/' . $filename;
                        $product_images->save();
                    }
                }
            }

        toastr()->success('Successfully Updated Products');
        return redirect(url('products'));
    }


    public function destroy($id)
    {
        $product = Product::where('id', $id)->first();
        $product_images = Image::where('product_id' , $product->id)->get();

//  delete folder of images if found in public folder to update them later
        if (isset($product_images)) {
                $folder = $product->name;
            $folder_by_id = $product->id;
                $path_folder = 'uploads/Products/';
//     delete folder of images
                if (File::exists($path_folder.$folder)) {
                    File::deleteDirectory($path_folder.$folder); // delete path from public uploads
                }
                else if(File::exists($path_folder.$folder_by_id)) {
                    File::deleteDirectory($path_folder.$folder_by_id);
                }
//     delete files of images
//            foreach ($product_images as $product_image) { عشان يلوب علي صوره صوره يحذفهم
//                $path_file = $product_image->image;
//                if (File::exists($path_file)) {
//                    File::delete($path_file); // delete file path from public uploads
//                }
//            }
        }

        $product->forceDelete();  // امسح ال Product بقا نهائيا

        toastr()->error('Successfully Deleted This Products');
        return redirect()->back();
    }

}
