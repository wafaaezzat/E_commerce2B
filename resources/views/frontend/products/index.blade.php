
@extends('layouts.app')

@section('title')
    {{$category->name}}
@endsection

@section('content')

{{--   products with same id category page  --}}
<div class="py-3 mb-4 shadow-sm bg-warning border-top">
    <div class="container">
        <h6 class="mb-0">
            <a href="{{route('category')}}">  {{trans('main_trans.Categories')}}  </a>
            /
            <a href="{{route('view_category' , $category->id)}}">  {{$category->name}}  </a>
        </h6>
    </div>
</div>


    <div class="container py-5">
        <div class="row">
            <h2 style="color: #fff"> {{$category->name}} </h2>
                @foreach($products as $prod)
                    <div class="col-md-3  mb-3">
                        <a href="{{route('view_product',[$category->id , $prod->id])}}">
                        <div class="card h-100">
                            <img src="{{asset($prod->banner_image)}}" height="150px" alt="">

                            <div class="card-body">
                                <h5> {{$prod->name}} </h5>
                                <p> {{$prod->desc}} </p>
                                <small class="float-start"> {{$prod->price}} {{trans('main_trans.LE')}} </small>
                                <small class="float-end"> <s> {{$prod->original_price}} {{trans('main_trans.LE')}} </s> </small>
                            </div>

                        </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        // items: 6,
        // autoplay: true,
        // autoplayTimeout: 3000,

        $('.owl-carousel').owlCarousel({
            items: 6,
            autoplay: true,
            autoplayTimeout: 3000,
            loop:true,
            margin:10,
            nav:true,
            dots:false,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:3
                },
                1000:{
                    items:5
                }
            }
        })
    </script>
@endsection
