@extends('admin.layouts.app', ['activePage' => 'ordersHistory', 'titlePage' => trans('Orders_trans.Orders_History')])

@section('titlePage')
    <title> {{trans('Orders_trans.Orders_History')}} </title>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{route('orders.index')}}" class="btn btn-primary end"> {{trans('Orders_trans.Orders_Page')}} </a>
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title "> {{trans('Orders_trans.Orders_History')}} </h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-primary">
                                    <th> {{trans('Orders_trans.Order_Date')}} </th>
                                    <th> {{trans('Orders_trans.Tracking_Number')}} </th>
                                    <th> {{trans('Orders_trans.Total_Price')}} </th>
                                    <th> {{trans('Orders_trans.Status')}} </th>
                                    <th> {{trans('Orders_trans.Actions')}} </th>
                                    </thead>
                                    <tbody>
                                    @foreach($ordersHistory as $item)
                                        <tr>
                                            <td>{{date('d-m-y' , strtotime($item->created_at))}}</td>
                                            <td>{{$item->tracking_no}}</td>
                                            <td>{{$item->total_price}}</td>
{{--                                            <td>{{$item->status == '0' ? 'pending' : 'completed'}}</td>{{-- pending=> في انتظار الشحن --}}
                                            <td class="px-2"> {{$item->status == '0' ? trans('Orders_trans.pending')  : trans('Orders_trans.completed') }} </td>
                                            <td>
                                                <a href="{{route('orders.show' , $item->id)}}" class="btn btn-primary btn-sm">
                                                    View
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
