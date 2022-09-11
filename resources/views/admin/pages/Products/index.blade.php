@extends('admin.layouts.app', ['activePage' => 'products', 'titlePage' => trans('Products_trans.Products_Page')])

@section('titlePage')
    <title> {{trans('Products_trans.Products_Page')}} </title>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{route('products.create')}}" class="btn btn-primary"> {{trans('Products_trans.addNewProduct')}} </a>
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title "> {{trans('Products_trans.addNewProduct')}}</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="text-primary">
                                    <th> # </th>
                                    <th> {{trans('Products_trans.Products_Category')}} </th>
                                    <th> {{trans('Products_trans.Products_Name')}} </th>
                                    <th> {{trans('Products_trans.Products_SellingPrice')}} </th>
                                    <th> {{trans('Products_trans.Products_Images')}} </th>
                                    <th> {{trans('Products_trans.Products_Action')}} </th>
                                    </thead>
                                    <tbody>
                                  <?php
                                       $i=1
                                    ?>
                                 @foreach($products as $product)
                                        <td>{{$i++}}</td>
                                        <td>{{$product->category->name}}</td>
                                        <td>{{$product->name}}</td>
                                        <td>{{$product->price}}</td>
                                        <td>
                                              <a href="{{URL::asset($product->banner_image)}}" target="_blank" >
                                                  <img src="{{asset($product->banner_image)}}" class="img-thumbnail" width="100" height="100">
                                              </a>
                                           </td>
                                        <td>
                                            <a href="{{route('products.edit', $product->id)}}" class="btn btn-primary btn-sm">
                                              <i class="far fa-edit"></i>
                                            </a>
                                            <form action="{{route('products.destroy', $product->id)}}" method="post" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Are You Sure To Delete This ProductRequest !?')">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                            </form>
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
