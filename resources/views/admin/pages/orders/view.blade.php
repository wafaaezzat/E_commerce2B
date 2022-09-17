@extends('admin.layouts.app', ['activePage' => 'orders', 'titlePage' => trans('Orders_trans.Order_Details')])

@section('titlePage')
    <title> {{trans('Orders_trans.Order_Details')}} </title>
@endsection

@section('content')
    <div class="container mt-5">
        <div class="row my-3 product_data"> {{-- product_data => مستخدمها فال ajax--}}

            <div class="col-md-12">
                <div class="card">
                    @if($Order)
                    <div class="card-header bg-primary">
                        <h5 class="text-white"> {{trans('Orders_trans.Order_View')}} </h5>
                        <a href="{{route('ordersHistory')}}" class="btn btn-warning float-end end"> {{trans('Orders_trans.Orders_History')}} </a>
                    </div>
                    <div class="card-body">
                        @if($Order->count() > 0)
                            <div class="row">
                                <div class="col-md-6 order-details">
                                    <h4> {{trans('Orders_trans.Shipping_Details')}} </h4>
                                    <hr>
                                    <label> {{trans('Orders_trans.First_Name')}} </label>
                                    <div class="border">{{$Order->user->firstname}}</div>

                                    <label> {{trans('Orders_trans.Last_Name')}} </label>
                                    <div class="border">{{$Order->user->lastname}}</div>

                                    <label> {{trans('Orders_trans.Email')}} </label>
                                    <div class="border">{{$Order->user->email}}</div>

                                    <label> {{trans('Orders_trans.Contact_No')}} </label>
                                    <div class="border">{{$Order->user->phone}}</div>

                                    <label> {{trans('Orders_trans.Detailed_Address')}} </label>
                                    <div class="border">
                                        {{$Order->user->address}}
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
                                            @foreach($Order->orderItems as $item)
                                                <tr>
                                                    <td>{{$item->products->name}}</td>
                                                    <td>{{$item->quantity}}</td>
                                                    <td> {{$item->price}} {{trans('main_trans.LE')}} </td>{{-- pending=> في انتظار الشحن --}}
                                                    <td>
                                                        <img src="{{asset($item->products->banner_image)}}" width="50px" alt="">
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <style>
                                        .end{
                                            float: right;
                                        }
                                    </style>

                                    <div class="my-4 float-end">
                                    <h4 class="px-2"> {{trans('Orders_trans.Grand_Total')}}: {{$Order->total_price}} {{trans('main_trans.LE')}}  </h4>
                                    <h4 class="px-2"> {{trans('Orders_trans.Payment_Mode')}}: {{$Order->payment_mode}} </h4>
                                    <form action="{{route('orders.update' , $Order->id)}}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <style>
                                            .form-select{
                                                display: block;
                                                width: 100%;
                                                padding: .375rem 2.25rem .375rem .75rem;
                                                -moz-padding-start: calc(0.75rem - 3px);
                                                font-size: 1rem;
                                                font-weight: 400;
                                                line-height: 1.5;
                                                color: #212529;
                                                background-color: #fff;
                                                background-image: url(data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e);
                                                background-repeat: no-repeat;
                                                background-position: right .75rem center;
                                                background-size: 16px 12px;
                                                border: 1px solid #ced4da;
                                                border-radius: .25rem;
                                                transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
                                                -webkit-appearance: none;
                                                -moz-appearance: none;
                                                appearance: none;
                                            }
                                        </style>
                                    <select class="form-select" name="status">
                                        <option disabled> ... </option>
                                        <option {{$Order->status == '0' ? 'selected' : ''}} value="0"> {{trans('Orders_trans.pending')}} </option>
                                        <option {{$Order->status == '1' ? 'selected' : ''}} value="1"> {{trans('Orders_trans.completed')}} </option>
                                    </select>
                                        <button class="btn btn-primary" type="submit"> {{trans('main_trans.update')}} </button>
                                    </form>
                                    </div>
                                </div>
                            </div>

                        @else
                            <div class="card-body text-center">
                                <h2> <i class="fa fa-shopping-cart"></i> {{trans('Orders_trans.Your_Orders_is_empty')}} </h2>
                                <a href="{{route('ordersHistory')}}" class="btn btn-outline-primary float-end"> {{trans('main_trans.Continue_to_ordersHistory')}} </a>
                            </div>
                        @endif

                        @else
                                <div class="card-body text-center">
                                    <h2> <i class="fa fa-shopping-cart"></i> {{trans('Orders_trans.Your_Orders_is_empty')}} </h2>
                                    <a href="{{route('ordersHistory')}}" class="btn btn-outline-primary float-end"> {{trans('main_trans.Continue_to_ordersHistory')}} </a>
                                </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
