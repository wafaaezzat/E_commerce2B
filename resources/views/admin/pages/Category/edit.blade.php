@extends('admin.layouts.app', ['activePage' => 'categories', 'titlePage' => trans('Categories_Trans.EditCategory')])

@section('titlePage')
    <title> {{trans('Categories_Trans.EditCategory')}} </title>
@endsection

@section('content')

    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h4> {{trans('Categories_Trans.EditCategory')}} </h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{url('update-category/'.$category->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label> {{trans('Categories_Trans.Name_En')}} </label>
                                <input type="text" name="name" id="name" required value="{{ $category->name}}" class="form-control">
                                @error('name')<div class="text-danger">{{$message}}</div>@enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label> {{trans('Categories_Trans.Description_En')}} </label>
                                <textarea rows="3" name="desc" id="desc" class="form-control" required> {{ $category->desc }} </textarea>
                                @error('desc')<div class="text-danger">{{$message}}</div>@enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="image">Select an Image:</label>
                                <input type="file" name="image" class="form-control" value="{{$category->image}}" required>
                                @error('image')<div class="text-danger">{{$message}}</div>@enderror
{{--                                value="{{ old('image') }}"--}}
                                @if($category->image)
                                    <img src="{{URL::asset($category->image)}}" alt="{{$category->image}}"
                                         class="img-thumbnail" width="100" height="100" />
                                @else
                                    <p>{{trans('main_trans.No_image')}}</p>
                                @endif

                            </div>

                            <div class="col-md-12">
                                <input type="submit" value="Update" class="btn btn-primary">
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
