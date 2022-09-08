
@extends('layouts.app')

@section('title')
     {{trans('main_trans.MyOrders')}}
@endsection

@section('content')
    <div class="py-3 mb-4 shadow-sm bg-warning border-top">
        <div class="container">
            <h6 class="mb-0">
                <a href="{{route('home')}}">  {{trans('main_trans.Dashboard')}}  </a>
                /
                <a href="{{route('checkOut')}}"> {{trans('main_trans.CheckOut')}} </a>
            </h6>
        </div>
    </div>


    <div class="container mt-5">
            <div class="row my-3 product_data"> {{-- product_data => مستخدمها فال ajax--}}

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5> {{trans('Orders_trans.Orders_Details')}} </h5>
                            <hr>

                            @if($orders->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead class=" text-primary">
                                        <th> {{trans('Orders_trans.Tracking_Number')}} </th>
                                        <th> {{trans('Orders_trans.Total_Price')}} </th>
                                        <th> {{trans('Orders_trans.Status')}} </th>
                                        <th> {{trans('Orders_trans.Actions')}} </th>
                                        </thead>
                                        <tbody>
                                        @foreach($orders as $item)
                                            <tr>
                                                <td>{{$item->tracking_no}}</td>
                                                <td>{{$item->total_price}} {{trans('main_trans.LE')}} </td>
                                                <td>{{$item->status == '0' ? 'pending' : 'completed'}}</td>{{-- pending=> في انتظار الشحن --}}
                                                <td>
                                                    <a href="{{route('view-my-order' , $item->id)}}" class="btn btn-primary btn-sm">
                                                        <i class="far fa-eye"></i>
                                                    </a>
                                                    <form action="{{route('delete-my-order', $item->id)}}" method="post" style="display: inline;">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Are You Sure To Delete This Order !?')">
                                                            <i class="far fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>


                            @else
                                <div class="card-body text-center">
                                    <h2> <i class="fa fa-shopping-cart"></i> {{trans('Orders_trans.Your_Orders_is_empty')}} </h2>
                                    <a href="{{route('category')}}" class="btn btn-outline-primary float-end"> {{trans('main_trans.Continue_to_Shopping')}} </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
    </div>
@endsection
