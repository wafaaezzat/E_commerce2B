@extends('admin.layouts.app', ['activePage' => 'add-product', 'titlePage' => trans('Products_trans.addNewProduct')])

@section('titlePage')
    <title> {{trans('Products_trans.addNewProduct')}} </title>
@endsection

@section('content')

    <div class="content">
        <div class="container-fluid">
            <a href="{{url('products')}}" class="btn btn-primary"> {{trans('Products_trans.Products_Page')}} </a>
            <div class="card">
                <div class="card-header">
                    <h4> {{trans('Products_trans.addNewProduct')}} </h4>
                </div>
                <div class="card-body">

                    @if(session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ session()->get('error') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">


                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <form method="post" action="{{route('products.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            <div class="col-12 mb-3">
                                <select class="form-control" name='category_id' required>
                                    <option selected disabled> {{trans('Products_trans.Select_Category')}} </option>
                                    @foreach($categories as $category)
                                    <option value="{{$category->id}}"> {{$category->name}} </option>
                                    @endforeach
                                </select>
                                @error('category_id')<div class="text-danger">{{$message}}</div>@enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label> {{trans('Products_trans.Name_En')}} </label>
                                <input type="text" name="name" id="name" class="form-control" required value="{{old('name')}}"/>
                                @error('name')<div class="text-danger">{{$message}}</div>@enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label> {{trans('Categories_Trans.Description_En')}} </label>
                                <textarea rows="3" name="desc" id="desc" class="form-control" required> {{ old('desc') }} </textarea>
                                @error('desc')<div class="text-danger">{{$message}}</div>@enderror
                            </div>


                            <div class="col-md-6 mb-3">
                                <label> {{trans('Products_trans.Products_OriginalPrice')}} </label>
                                <input type="text" name="price" class="form-control" value="{{ old('price') }}" required>
                                @error('price')<div class="text-danger">{{$message}}</div>@enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label> {{trans('Products_trans.Quantity')}} </label>
                                <input type="number" name="quantity" class="form-control" value="{{ old('quantity') }}" required>
                                @error('quantity')<div class="text-danger">{{$message}}</div>@enderror
                            </div>

                            <div class="col-md-3 mb-3">
                                <label> {{trans('Categories_Trans.Status')}} </label>
                                <input type="checkbox" name="status">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label> {{trans('Products_trans.Trending')}} </label>
                                <input type="checkbox" name="trending">
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="myfile">Select a Banner Image:</label>
                                <input type="file" id="banner_image" name="banner_image" class="form-control" value="{{ old('banner_image') }}" required>
                                @error('banner_image')<div class="text-danger">{{$message}}</div>@enderror
                            </div>

{{-- multiple --}}
                            <div class="col-md-12 mb-3">
                                <label for="images">Select Multiple Images:</label>
                                <input type="file" multiple id="images" name="images[]" class="form-control" value="{{ old('images') }}" required>
                                @error('images')<div class="text-danger">{{$message}}</div>@enderror
                            </div>

                            <div class="col-md-12">
                                <button class="btn btn-primary" type="submit"> {{trans('main_trans.submit')}} </button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
