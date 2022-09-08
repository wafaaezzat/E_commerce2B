
@extends('layouts.app')

@section('title')
     {{trans('main_trans.myCheckOut')}}
@endsection

@section('content')
    <div class="py-3 mb-4 shadow-sm bg-warning border-top">
        <div class="container">
            <h6 class="mb-0">
                <a href="{{route('home')}}">  {{trans('main_trans.Dashboard')}}  </a>
                /
                <a href="{{route('checkOut')}}">  {{trans('main_trans.CheckOut')}} </a>
            </h6>
        </div>
    </div>


    <div class="container mt-5">
<form action="{{route('place-order')}}" method="post">
    @csrf
        <div class="row my-3 product_data"> {{-- product_data => مستخدمها فال ajax--}}
            <div class="col-md-7">
                <div class="card">

                    <div class="card-body">
                        <h5> {{trans('CheckOut_Trans.Basic_Details')}} </h5>
                        <hr>
                        <div class="row checkout-form">

                            <div class="col-md-6">
                                <label> {{trans('Orders_trans.First_Name')}} </label>
                                <input type="text" name="fname" value="{{Auth::user()->name}}" class="form-control firstname" placeholder="enter your first name" required>
                                <span id="fname_error" class="text-danger form-control-sm"> </span>
                            </div>

                            <div class="col-md-6">
                                <label> {{trans('Orders_trans.Last_Name')}} </label>
                                <input type="text" name="lname" value="{{auth()->user()->lname}}" class="form-control lastname" placeholder="enter your last name" required>
                                <span id="lname_error" class="text-danger form-control-sm"> </span>
                            </div>

                            <div class="col-md-6">
                                <label> {{trans('Orders_trans.Email')}} </label>
                                <input type="email" name="email" value="{{auth()->user()->email}}" class="form-control email" placeholder="enter your e-mail" required>
                                <span id="email_error" class="text-danger form-control-sm"> </span>
                            </div>

                            <div class="col-md-6">
                                <label> {{trans('Orders_trans.Contact_No')}} </label>
                                <input type="text" name="phoneNumber" value="{{Auth::user()->phone}}" class="form-control phone" placeholder="enter your phone number" required>
                                <span id="phone_error" class="text-danger form-control-sm"> </span>
                            </div>

                            <div class="col-md-6">
                                <label> {{trans('Orders_trans.Detailed_Address')}} </label>
                                <input type="text" name="address" value="{{Auth::user()->address}}" class="form-control address" placeholder="enter your address" required>
                                <span id="address_error" class="text-danger form-control-sm"> </span>
                            </div>

{{--                            <div class="col-md-6">--}}
{{--                                <label> {{trans('Orders_trans.Detailed_Address')}} </label>--}}
{{--                                <input type="text" name="address2" value="{{Auth::user()->address2}}" class="form-control address2" placeholder="enter your address 2" required>--}}
{{--                                <span id="address2_error" class="text-danger form-control-sm"> </span>--}}
{{--                            </div>--}}

                            <div class="col-md-6">
                                <label> {{trans('CheckOut_Trans.City')}} </label>
                                <input type="text" name="city" value="{{Auth::user()->city}}" class="form-control city" placeholder="enter your city" required>
                                <span id="city_error" class="text-danger form-control-sm"> </span>
                            </div>

                            <div class="col-md-6">
                                <label> {{trans('CheckOut_Trans.State')}} </label>
                                <input type="text" name="state" value="{{Auth::user()->state}}" class="form-control state" placeholder="enter your state" required>
                                <span id="state_error" class="text-danger form-control-sm"> </span>
                            </div>

                            <div class="col-md-6">
                                <label> {{trans('CheckOut_Trans.Country')}} </label>
                                <input type="text" name="country" value="{{Auth::user()->country}}" class="form-control country" placeholder="enter your country" required>
                                <span id="country_error" class="text-danger form-control-sm"> </span>
                            </div>

                            <div class="col-md-6">
                                <label> {{trans('Orders_trans.Zip_Code')}} </label>
                                <input type="text" name="pinCode" value="{{Auth::user()->pincode}}" class="form-control pincode" placeholder="enter your pin Ccde" required>
                                <span id="pincode_error" class="text-danger form-control-sm"> </span>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <h5> {{trans('Orders_trans.Order_Details')}} </h5>
                        <hr>

                        @if($cartItems->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead class=" text-primary">
                                <th> {{trans('CheckOut_Trans.Name')}} </th>
                                <th> {{trans('Products_trans.Quantity')}} </th>
                                <th> {{trans('Products_trans.Size')}}</th>
                                <th> {{trans('Orders_trans.Total_Price')}} </th>
                                </thead>
                                <tbody>
                                @php $total = 0 @endphp
                                @foreach($cartItems as $item)
                                    <tr>
                                        <td>{{$item->product->name}}</td>
                                        <td>{{$item->product_quantity}}</td>
                                        <td>{{$item->size}}</td>
                                        <?php
                                        $num1 = $item->product->selling_price;
                                        $num2 = $item->product_quantity;
                                        $multiplication  = $num1 * $num2;
                                        ?>
                                        <td class="text-primary"> {{$multiplication}} {{trans('main_trans.LE')}}</td>
                                        <input type="hidden" name="price" value="{{$multiplication}}">
                                    </tr>
                                    @php $total += $item->product->selling_price * $item->product_quantity @endphp
                                @endforeach
                                </tbody>
                            </table>
{{--                            <h6 class="px-2"> {{trans('Orders_trans.Grand_Total')}}: --}}
{{--                                <span class="float-end total_price"> {{$total}} {{trans('main_trans.LE')}} </span> --}}
{{--                            </h6>--}}
                            <h6> {{trans('Orders_trans.Total_Price')}}:
                                @if(\Illuminate\Support\Facades\App::getLocale() == 'ar')
                                    <span class="float-start total_price"> {{$total}} {{trans('main_trans.LE')}} </span>
                                @elseif(\Illuminate\Support\Facades\App::getLocale() == 'en')
                                    <span class="float-end total_price"> {{$total}} {{trans('main_trans.LE')}} </span>
                                @endif
                            </h6>
                        </div>
                        <input type="hidden" name="payment_mode" value="COD">

                     @if($news)
                        <label> {{trans('CheckOut_Trans.Promo_Code')}}: </label>
                        <input type="text" name="promocode" placeholder="{{trans('CheckOut_Trans.enter_Promo_Code')}}" class="form-control mb-2" style="border-radius:10%" >
                     @endif

                            <button type="submit" class="btn btn-success w-100"> {{trans('CheckOut_Trans.PlaceOrder')}} </button>
                        <button type="button" class="btn btn-primary w-100 mt-3 Razorpay_btn"> Pay with Razorpay </button>
                            <!-- Set up a container element for the button -->
                            <div id="paypal-button-container"></div>

                        @else
                            <div class="card-body text-center">
                                <h2>  <i class="fa fa-shopping-cart"></i>  {{trans('Carts_Trans.Your_Cart_is_empty')}} </h2>
                                <a href="{{route('category')}}" class="btn btn-outline-primary float-end">  {{trans('main_trans.Continue_to_Shopping')}} </a>
                        @endif
                    </div>
                </div>
            </div>

        </div>
</form>
    </div>
@endsection

@section('script')
    <script src="https://www.paypal.com/sdk/js?client-id=Ae6UraAc0kRIqRfPbVgi-8D1hTpMaLwmcH5yUamoVftcS3FBHF_zOMQ8FJQVL6TjJCMKnsQ_oDbRcyiV&currency=USD"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

    <script>
        paypal.Buttons({

            // Sets up the transaction when a payment button is clicked
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        @if(isset($total))
                        amount: {
                            value: '{{$total}}'// Can reference variables or functions. Example: `value: document.getElementById('...').value`
                        }
                        @endif
                    }]
                });
            },

            // Finalize the transaction after payer approval
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(orderData) {
                    // Successful capture! For dev/demo purposes:
                    // console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                    // var transaction = orderData.purchase_units[0].payments.captures[0];
                    // alert('Transaction '+ transaction.status + ': ' + transaction.id + '\n\nSee console for all available details');

                    var firstname = $('.firstname').val();
                    var lastname  = $('.lastname').val();
                    var email     = $('.email').val();
                    var phone     = $('.phone').val();
                    var address   = $('.address').val();
                    // var address2  = $('.address2').val();
                    var city      = $('.city').val();
                    var state     = $('.state').val();
                    var country   = $('.country').val();
                    var pincode   = $('.pincode').val();


                    $.ajax({
                        method: "POST",
                        url: "/place-order",
                        data: {
                            'fname': firstname,
                            // 'fname' => it came from [$request->fname;] in function (PlaceOrder) in CheckOutControllerphp
                            'lname': lastname,
                            'email': email,
                            'phoneNumber': phone,
                            'address': address,
                            // 'address2': address2,
                            'city': city,
                            'state': state,
                            'country': country,
                            'pinCode': pincode,
                            'payment_mode': 'Paid by Paypal',
                            'payment_id': orderData.id,
                        },
                        success: function (response) {
                            // window.location.reload();
                            // alert(response.status);

                            window.location.href = '/my-order';
                            return response;
                        }
                    });

                });
            }
        }).render('#paypal-button-container');

    </script>

@endsection
