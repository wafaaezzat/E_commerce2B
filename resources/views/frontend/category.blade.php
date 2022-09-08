
@extends('layouts.app')

    @section('title')
         {{trans('Categories_Trans.Dandy_Categories')}}
    @endsection

    @section('content')

{{--       @include('frontend.layouts.slider')--}}

        <div class="container py-5">
            <div class="row">
                <h2 style="color: #fff"> {{trans('Categories_Trans.Features_Categories')}} </h2>
                <div class="owl-carousel owl-theme mt-5">
                @foreach($featured_categories as $cat)
                    <div class="item">
                        <a href="{{route('view_category',$cat->id)}}">
                        <div class="card h-100">
                            <img src="{{asset($cat->image)}}" height="150px" alt="">

                            <div class="card-body">
                                <h5> {{$cat->name}} </h5>
                                <p> {{$cat->description}} </p>
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
