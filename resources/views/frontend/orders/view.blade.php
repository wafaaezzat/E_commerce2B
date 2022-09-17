
@extends('layouts.app')

@section('title')
    {{trans('Orders_trans.Order_Details')}}
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
                    @if($myOrder)
                    <div class="card-header bg-primary">
                        <h5 class="text-white"> {{trans('Orders_trans.Order_View')}}
                            @if(\Illuminate\Support\Facades\App::getLocale() == 'ar')
                                <a href="{{route('my-order')}}" class="btn btn-warning float-start"> {{trans('main_trans.Back')}} </a>
                            @elseif(\Illuminate\Support\Facades\App::getLocale() == 'en')
                                <a href="{{route('my-order')}}" class="btn btn-warning float-end"> {{trans('main_trans.Back')}} </a>
                            @endif

                        </h5>
                    </div>
                        <div class="card-body">

                        @if($myOrder->count() > 0)
                            <div class="row">
                                <div class="col-md-6 order-details">
                                    <h4> {{trans('Orders_trans.Shipping_Details')}} </h4>
                                    <hr>
                                    <label> {{trans('Orders_trans.First_Name')}} </label>
                                    <div class="border">{{\Illuminate\Support\Facades\Auth::user()->firstname}}</div>

                                    <label> {{trans('Orders_trans.Last_Name')}} </label>
                                    <div class="border">{{\Illuminate\Support\Facades\Auth::user()->lastname}}</div>

                                    <label> {{trans('Orders_trans.Email')}} </label>
                                    <div class="border">{{\Illuminate\Support\Facades\Auth::user()->email}}</div>

                                    <label> {{trans('Orders_trans.Contact_No')}} </label>
                                    <div class="border">{{\Illuminate\Support\Facades\Auth::user()->phone}}</div>

                                    <label> {{trans('Orders_trans.Detailed_Address')}} </label>
                                    <div class="border">
                                        {{\Illuminate\Support\Facades\Auth::user()->address}}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <h4> {{trans('Orders_trans.Order_Details')}} </h4>
                                    <hr>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <thead class=" text-primary">
                                            <th> {{trans('Orders_trans.NameOrder')}} </th>
                                            <th> {{trans('Orders_trans.QuantityOrder')}} </th>
                                            <th> {{trans('Orders_trans.PriceOrder')}} </th>
                                            <th> {{trans('Orders_trans.ImageOrder')}} </th>
                                            </thead>
                                            <tbody>
                                            @foreach($myOrder->orderItems as $item)
                                                <tr>
                                                    <td>{{$item->products->name}}</td>
                                                    <td>{{$item->quantity}}</td>
                                                    <td>{{$item->price}} {{trans('main_trans.LE')}} </td>{{-- pending=> في انتظار الشحن --}}
                                                    <td>
                                                       <img src="{{asset($item->products->banner_image)}}" width="50px" alt="">
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
{{--                                    <h4 class="px-2"> {{trans('Orders_trans.Grand_Total')}}: <span class="float-end"> {{$myOrder->total_price}} LE </span> </h4>--}}
                                    <h4 class="px-2"> {{trans('Orders_trans.Grand_Total')}}:  {{$myOrder->total_price}} {{trans('main_trans.LE')}}  </h4>
                                    <h6 class="px-2"> {{trans('Orders_trans.Payment_Mode')}}: {{$myOrder->payment_mode}} </h6>
                                    <h6 class="px-2"> {{trans('Orders_trans.charging_status')}}: {{$myOrder->status == '0' ? trans('Orders_trans.pending')  : trans('Orders_trans.completed') }}   </h6>
                                </div>
                            </div>

                        @else
                            <div class="card-body text-center">
                                <h2> <i class="fa fa-shopping-cart"></i> {{trans('Orders_trans.Your_Orders_is_empty')}} </h2>
                                <a href="{{route('category')}}" class="btn btn-outline-primary float-end"> {{trans('main_trans.Continue_to_Shopping')}} </a>
                            </div>
                        @endif
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
