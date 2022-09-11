@extends('admin.layouts.app', ['activePage' => 'add-category', 'titlePage' => trans('Categories_Trans.addNewCategory')])

@section('titlePage')
    <title> {{trans('Categories_Trans.addNewCategory')}} </title>
@endsection

@section('content')

    <div class="content">
        <div class="container-fluid">
            <a href="{{url('categories')}}" class="btn btn-primary"> {{ __('Categories') }} </a>
            <div class="card">
                <div class="card-header">
                    <h4> {{trans('Categories_Trans.addNewCategory')}} </h4>
                </div>
                <div class="card-body">
                    <form method="post" action="{{url('store-category')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label> {{trans('Categories_Trans.Name_En')}} </label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                                @error('name')<div class="text-danger">{{$message}}</div>@enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label> {{trans('Categories_Trans.Description_En')}} </label>
                                <textarea rows="3" name="desc" id="desc" class="form-control" required> {{ old('desc') }} </textarea>
                                @error('desc')<div class="text-danger">{{$message}}</div>@enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="image">Select an Image:</label>
                                <input type="file" id="image" name="image" class="form-control" value="{{ old('image') }}" required>
                                @error('image')<div class="text-danger">{{$message}}</div>@enderror
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
