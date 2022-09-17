@extends('admin.layouts.app', ['activePage' => 'ordersHistory', 'titlePage' => trans('Users_trans.Client_Details')])

@section('titlePage')
    <title> {{trans('Users_trans.Client_Details')}} </title>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{route('users')}}" class="btn btn-primary end"> {{ trans('main_trans.Back') }} </a>
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title "> Users Details </h4>
                        </div>
                        <div class="card-body">

                      <div class="row">
                          <div class="col-md-4 mt-3">
                              <label> {{trans('Users_trans.Role')}} </label>
                              <div class="border p-2">{{$user->role == '0'?'User':'Admin'}}</div>
                          </div>

                          <div class="col-md-4 mt-3">
                              <label> {{trans('Orders_trans.First_Name')}} </label>
                              <div class="border p-2">{{$user->firstname}}</div>
                          </div>

                          <div class="col-md-4 mt-3">
                          <label> {{trans('Orders_trans.Last_Name')}} </label>
                          <div class="border p-2">{{$user->lastname}}</div>
                          </div>

                          <div class="col-md-4 mt-3">
                          <label> {{trans('Orders_trans.Email')}} </label>
                          <div class="border p-2">{{$user->email}}</div>
                          </div>

                          <div class="col-md-4 mt-3">
                          <label> {{trans('Orders_trans.Contact_No')}} </label>
                          <div class="border p-2">{{$user->phone}}</div>
                          </div>

                          <div class="col-md-4 mt-3">
                          <label> {{trans('Orders_trans.Detailed_Address')}} </label>
                          <div class="border p-2">
                              {{$user->address}}
                          </div>
                          </div>

                      </div>
                      </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
