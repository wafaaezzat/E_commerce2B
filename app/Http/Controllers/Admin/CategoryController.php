<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{


    public function __construct(){   // عشان احمي ان مش اي حد يقدر يخش علي الا م يسجل الاول
        $this->middleware('auth');
    }


    public function index()
    {
        $categories = Category::all();
        return view('admin.pages.Category.index' , compact('categories'));
    }



    public function add()
    {
        return view('admin.pages.Category.add');
    }


    public function store(CategoryRequest $request)
    {

        try {
            $validator = $request->validated();

            if (!$validator){
                toastr()->error('عذرا البيانات التي ادخلتها غير صحيحه');
                return redirect()->route('add-category.add')->withErrors($validator)->withInput();
            }


            if($request->hasFile('image')) {
                $photo = $request->image;
                $newPhoto = time() . $photo->getClientOriginalName(); // getClientOriginalName بيفصلي ام الصوره عن الامتداد بتاعها
//  time() => عشان يكريتلي رقم عشوائي قبل اسم الصوه عشان لو الصوره اتكررت ترتفع عادي بس اسمها هيختلف عشان الرقم العشوائي دا
                $photo->move(public_path('uploads/Category/' . $request->name), $newPhoto);
            }
              \App\Models\Category::create([
                    'name' => $request->name,
                    'desc' => $request->desc,
                    'image' => 'uploads/Category/' . $request->name . '/'. $newPhoto,  // $file_name => هي اسم الصوره بدون امتداد
                ]);


            toastr()->success('Successfully Created Category');
            return redirect()->back();
        }
        catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }



    public function edit($id)
    {
        $category = \App\Models\Category::where('id', $id)->first();
        return view('admin.pages.Category.edit' , compact('category'));
    }


    public function update(CategoryRequest $request, $id)
    {
        $category = \App\Models\Category::where('id', $id)->first();

        $validator = $request->validated();

        if (!$validator){
            toastr()->error('عذرا البيانات التي ادخلتها غير صحيحه');
            return redirect()->route('add-category.add')->withErrors($validator)->withInput();
        }

            if($request->hasFile('image')) {

                $path = $category->image;
                if(File::exists($path)) {
                    File::delete($path); // delete path from public uploads
                }
                $photo = $request->file('image');
                $newPhoto = time() . $photo->getClientOriginalName(); // getClientOriginalName بيفصلي ام الصوره عن الامتداد بتاعها
//  time() => عشان يكريتلي رقم عشوائي قبل اسم الصوه عشان لو الصوره اتكررت ترتفع عادي بس اسمها هيختلف عشان الرقم العشوائي دا
                $photo->move(public_path('uploads/Category/' . $request->id), $newPhoto); // put photo in filed in public uploads

                // هحط تعديل الصوره هنا عشان لو مفيش صوره يحط القديمه زي م هي وميطلعش اي ايررور بس كدا
                $category->image = 'uploads/Category/' . $request->id . '/'. $newPhoto;  // $file_name => هي اسم الصوره بدون امتداد
            }
                $category->name  = $request->name;
                $category->desc = $request->desc;
                $category->update();


            toastr()->success('Successfully Updated Category');
            return redirect(url('categories'));

    }


    public function delete($id) {  // لما بنمسح الاب اللي هو category بيتمسح تلقائي الابن اللي هما ال products

       $category = Category::where('id', $id)->first();  // product => this function in Model CategoryRequest

        if($category->image) {
            // طريقه اخري
            $path = $category->image;
            if(File::exists($path)) {
                File::delete($path); // delete path from public uploads  (delete this image for path)
            }
        }
        // احذف الفولدر كامل بتاع ال slug دي باللي فيه مش المفات بس يعني
        // قولتلو احذف المرفقات الاول قبل ال product نفسها عشان يحذفها من الفولدر عندي
        // اما ل خليتها بعد ال product كدا هتتحذف من الداتابيز بس ومش هتتحذف من الفولدر

        $products = Product::where('category_id', $id)->get();  // عشان امسح اللي فولدرات ال products برضة من المشروع

        foreach ($products as $product) {
            if ($product->image) {
                $path = $product->image;
                if (File::exists($path)) {
                    File::delete($path); // delete path from public uploads (delete this image for path)
                }
            }
        }

        $category->delete();
        toastr()->error('Successfully Deleted this Category with his children Products');
        return redirect()->back();
    }
}
