@extends('admin.layouts.app', ['activePage' => 'categories', 'titlePage' => trans('Categories_Trans.Categories_Page')])

@section('titlePage')
    <title> {{trans('Categories_Trans.Categories_Page')}} </title>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{url('add-category')}}" class="btn btn-primary"> {{trans('Categories_Trans.addNewCategory')}} </a>
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title "> {{trans('Categories_Trans.Categories')}} </h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-primary">
                                    <th> # </th>
                                    <th> {{trans('Categories_Trans.Categories_Name')}} </th>
                                    <th> {{trans('Categories_Trans.Categories_Description')}} </th>
                                    <th> {{trans('Categories_Trans.Categories_Image')}} </th>
                                    <th> {{trans('Categories_Trans.Categories_Action')}} </th>
                                    </thead>
                                    <tbody>
                                  <?php
                                       $i=1
                                    ?>
                                 @foreach($categories as $category)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$category->name}}</td>
                                        <td>{{$category->desc}}</td>
                                        <td>
                                            @if(isset($category->image))
                                           <a href="{{URL::asset($category->image)}}" target="_blank">
                                               <img src="{{URL::asset($category->image)}}" alt="{{$category->image}}"
                                                    class="img-thumbnail" width="100" height="100" />
                                           </a>
                                                @endif
                                        </td>
                                        <td>
                                            <a href="{{route('edit-category', $category->id)}}" class="btn btn-primary btn-sm">
                                              <i class="far fa-edit"></i>
                                            </a>
                                            <a href="{{route('delete-category', $category->id)}}" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are You Sure To Delete This CategoryRequest')">
                                                <i class="far fa-trash-alt"></i>
                                            </a>
                                        </td>
                                    </tr>
                                 @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
