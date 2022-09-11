@extends('admin.layouts.app', ['activePage' => 'products', 'titlePage' => trans('Products_trans.EditProduct')])

@section('titlePage')
    <title> {{trans('Products_trans.EditProduct')}} </title>
@endsection

@section('content')

    <div class="content">
        <div class="container-fluid">
            <a href="{{url('products')}}" class="btn btn-primary"> {{trans('Products_trans.Products')}} </a>
            <div class="card">
                <div class="card-header">
                    <h4> {{trans('Products_trans.addNewProduct')}} </h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('products.update' , $product->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <input type="hidden" name="id" value="{{$product->id}}">
                            <div class="col-12 mb-3">
                                <select class="form-control" name='category_id' required>
                                    <option selected disabled> {{trans('Products_trans.Select_Category')}} </option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}" @if($category->id == $product->category_id) selected @endif>
                                            {{$category->name}} </option>
                                    @endforeach
                                </select>
                                @error('category_id')<div class="text-danger">{{$message}}</div>@enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label> {{trans('Products_trans.Name_En')}} </label>
                                <input type="text" name="name" id="name" value="{{ $product->name }}" class="form-control" required>
                                @error('name')<div class="text-danger">{{$message}}</div>@enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label> {{trans('Categories_Trans.Description_Ar')}} </label>
                                <textarea rows="3" name="desc" id="desc" class="form-control" required> {{ $product->desc }} </textarea>
                                @error('desc')<div class="text-danger">{{$message}}</div>@enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label> {{trans('Products_trans.Products_OriginalPrice')}} </label>
                                <input type="text" name="price" class="form-control" value="{{$product->price}}" required>
                                @error('price')<div class="text-danger">{{$message}}</div>@enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label> {{trans('Products_trans.Quantity')}} </label>
                                <input type="number" name="quantity" class="form-control" value="{{$product->quantity}}" required>
                                @error('quantity')<div class="text-danger">{{$message}}</div>@enderror
                            </div>

                            <div class="col-md-3 mb-3">
                                <label> {{trans('Categories_Trans.Status')}} </label>
                                <input type="checkbox" name="status" {{$product->status == '1' ? 'checked' : ''}}>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label> {{trans('Products_trans.Trending')}} </label>
                                <input type="checkbox" name="trending" {{$product->trending == '1' ? 'checked' : ''}}>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="myfile">Select a Banner Image:</label>
                                <input type="file" id="banner_image" name="banner_image" class="form-control" value="{{ old('banner_image') }}" required>
                                @error('banner_image')<div class="text-danger">{{$message}}</div>@enderror
                                @if($product->banner_image)
                                    <img src="{{URL::asset($product->banner_image)}}" alt="{{$product->banner_image}}"
                                         class="img-thumbnail" width="100" height="100" />
                                @else
                                    <p>{{trans('main_trans.No_image')}}</p>
                                @endif
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="myfile">Select Multiple Images:</label>
                                <input type="file" multiple id="images" name="images[]" class="form-control" value="{{ old('images') }}" required>
                                @error('images')<div class="text-danger">{{$message}}</div>@enderror

                                @foreach($product->productImages as $image)
                                    @if(isset($image->image))
                                            <img src="{{URL::asset($image->image)}}" alt="{{$image->image}}"
                                                 class="img-thumbnail" width="100" height="100" />
                                    @else
                                        <p>{{trans('main_trans.No_image')}}</p>
                                    @endif
                                @endforeach

                            </div>

                            <div class="col-md-12">
                                <button class="btn btn-primary" type="submit"> {{trans('main_trans.update')}} </button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
