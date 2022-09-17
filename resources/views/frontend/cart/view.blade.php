
@extends('layouts.app')

@section('title')
     {{trans('main_trans.MyCart')}}
@endsection

@section('content')
    <div class="py-3 mb-4 shadow-sm bg-warning border-top">
        <div class="container">
            <h6 class="mb-0">
                <a href="{{route('home')}}">  {{trans('main_trans.Dashboard')}}  </a>
                /
                <a href="{{route('cart')}}">  {{trans('main_trans.Cart')}} </a>
            </h6>
        </div>
    </div>


    <div class="container">
        <div class="card shadow cartitems">
            @if($cartItems->count() > 0)
            <div class="card-body">
                @php $total = 0 @endphp
             @foreach($cartItems as $item)
                <div class="row my-3 product_data"> {{-- product_data => مستخدمها فال ajax--}}
                    <div class="col-md-2">
                        <img src="{{asset($item->product->banner_image)}}" height="70px" width="70px" alt="">
                    </div>

                    <div class="col-md-3 my-auto">
                        <h3> {{$item->product->name}} </h3>
                    </div>

                    <div class="col-md-2 my-auto">
                        <h6> {{$item->product->price}} {{trans('main_trans.LE')}}  </h6>
                    </div>


                    <input type="hidden" class="prod_id"  value="{{$item->product_id}}">

                    @if($item->product->quantity >= $item->quantity)
                    <div class="col-md-3">
                        <label> Quantity </label>
                        <div class="input-group text-center mb-3" style="width: 130px">
                            <button class="input-group-text changeQuantity decrement-btn" style="cursor: default"> - </button>
                            <input type="text" name="quantity" value="{{$item->quantity}}" class="form-control text-center qty-input">
                            <button class="input-group-text changeQuantity increment-btn" style="cursor: default"> + </button>
                        </div>
                    </div>

                            @php $total += $item->product->price * $item->quantity @endphp
                        @else
                        <div class="col-md-3">
                            <div class="input-group text-center mb-3" style="width: 190px;">
                                <button class="input-group-text changeQuantity decrement-btn" style="cursor: default"> - </button>
                                <input type="text" name="quantity" value="{{$item->quantity}}" class="form-control text-center qty-input">
                                <h6 class="badge bg-danger">  {{trans('Carts_Trans.Out_Of_Stock')}} </h6>
                            </div>
                        </div>
                         @endif

                    <div class="col-md-2 my-auto">
                        <button class="btn btn-danger btn-sm delete-cart-item"
                           onclick="return confirm('Are You Sure To Delete This ProductRequest from Cart')">
                            <i class="far fa-trash-alt"></i>
                        </button>
                    </div>

               </div>
             @endforeach
        </div>

            <div class="card-footer">
              <h6> {{trans('Orders_trans.Total_Price')}} {{$total}} {{trans('main_trans.LE')}}
                  @if(\Illuminate\Support\Facades\App::getLocale() == 'ar')
                  <a href="{{route('checkOut')}}" class="btn btn-outline-success float-start">  {{trans('Carts_Trans.Proceed_to_CheckOut')}} </a>
                      @elseif(\Illuminate\Support\Facades\App::getLocale() == 'en')
                      <a href="{{route('checkOut')}}" class="btn btn-outline-success float-end">  {{trans('Carts_Trans.Proceed_to_CheckOut')}} </a>
                    @endif
              </h6>
            </div>

            @else

                <div class="card-body text-center">
                    <h2>  <i class="fa fa-shopping-cart"></i>  {{trans('Carts_Trans.Your_Cart_is_empty')}} </h2>
                    <a href="{{route('category')}}" class="btn btn-outline-primary float-end">  {{trans('main_trans.Continue_to_Shopping')}} </a>
                </div>

            @endif


    </div>
        <br><br>
{{--    {!! $cartItems->links() !!}--}}
@endsection
