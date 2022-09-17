
@extends('layouts.app')

@section('title')
    {{$product->name}}
@endsection

@section('content')

{{--   product show page --}}

    <div class="py-3 mb-4 shadow-sm bg-warning border-top">
        <div class="container">
            <h6 class="mb-0">
                <a href="{{route('category')}}">  {{trans('main_trans.Collections')}}  </a>
                /
               <a href="{{route('view_category' , $product->category->id)}}">  {{$product->category->name}}  </a>
                /
                <a href="{{route('view_product' ,[$product->category->id , $product->id] )}}"> {{$product->name}}  </a>
            </h6>
        </div>
     </div>


    <div class="container pb-5">
        <div class="card shadow product_data">  {{-- product_data => مستخدمها فال ajax--}}
            <div class="card-body">
                <div class="row">

                    <div class="col-md-4 border-right">
                        <a href="{{URL::asset($product->banner_image)}}" target="_blank" style="width: 100%">
                        <img src="{{asset($product->banner_image)}}" class="w-100" alt="">
                        </a>
                    </div>

                    <div class="col-md-8">
                        <h2 class="mb-0">
                          {{$product->name}}
                          @if($product->trending == '1')
                                @if(\Illuminate\Support\Facades\App::getLocale() == 'ar')
                                    <label class=" badge bg-danger trending_tag float-start" style="font-size:16px"> {{trans('Products_trans.Trending')}} </label>
                                @elseif(\Illuminate\Support\Facades\App::getLocale() == 'en')
                                    <label class=" badge bg-danger trending_tag float-end" style="font-size:16px"> {{trans('Products_trans.Trending')}} </label>
                                @endif
                          @endif
                        </h2>
                        <hr>
                        <label class="me-3" style="font-size:16px"> {{trans('Products_trans.Original_Price')}}: <s> {{$product->price}} {{trans('main_trans.LE')}} </s> </label>
                        <br>
                        <label class="fw-bold" style="font-size:16px"> {{trans('Products_trans.Selling_Price')}}: {{$product->price}} {{trans('main_trans.LE')}} </label>

                        <p class="mt-3">
                          {!! $product->desc !!}
                        </p>
                        <hr>


                        @if($product->quantity > 0)
                            <label class="badge bg-success"> {{trans('Carts_Trans.In_Stock')}}   @if($product->quantity <= 10)
                            {{$product->quantity}} {{trans('main_trans.quantity_only')}} @endif </label>
                        @else
                            <label class="badge bg-danger"> {{trans('Carts_Trans.Out_Of_Stock')}} </label>
                        @endif

                        <div class="row mt-2">
                            <div class="col-md-3">
                                <label> {{trans('Products_trans.Quantity')}} </label>
                                <div class="input-group text-center mb-3">
                                    <input type="hidden" name="prod_id" value="{{$product->id}}" class="prod_id">
                                    <button class="input-group-text decrement-btn" style="cursor: default"> - </button>
                                    <input type="text" name="quantity" value="1" class="form-control text-center qty-input">
                                    <button class="input-group-text increment-btn" style="cursor: default"> + </button>
                                </div>
                            </div>

                            @if($product->quantity > 0)
                            <div class="col-md-4">
                                <br>
                                    <button type="submit" class="btn btn-primary me-3  AddToCartBtn"> {{trans('Products_trans.Add_to_Cart')}} <i class="fa-solid fa-cart-arrow-down"></i> </button>
                            </div>

                            @else
                                <h3> not found to add to cart</h3>
                            @endif

                        </div>
                    </div>

                    <div class="col-md-12">
                        <hr>
                        <h3> {{trans('Products_trans.Description')}} </h3>
                        <p class="mt-3">
                            {!! $product->desc !!}
                        </p>
                    </div>

                    <div class="col-md-12 py-5">
                        @foreach($product->productImages as $image)
                            @if(isset($image->image))
                                <a href="{{URL::asset($image->image)}}" target="_blank">
                                    <img src="{{URL::asset($image->image)}}" alt="{{$image->image}}"
                                         class="img-thumbnail" width="30%" height="30%" />
                                </a>
                            @endif
                        @endforeach
                    </div>

                </div>

            </div>
        </div>
    </div>

    <script>
        var APP_URL = "{{ env('APP_URL') }}";
        localStorage.setItem('APP_URL', APP_URL); // set app url to storage to get after on js file to work

    </script>
@endsection
