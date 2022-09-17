
@extends('layouts.app')

    @section('title')
         {{trans('main_trans.Welcome_dandy')}}
    @endsection

    @section('content')

       @include('frontend.layouts.slider')

{{-- Start Category --}}
       @if($featured_categories->count() >= 1)
       <div class="container py-5">
           <div class="row" id="Features_Categories">
               <h3 class="fav-title text-center mb-5" style="color: #fff">
                   <span class="right"></span>
                   {{trans('main_trans.Features_Categories')}}
                   <span class="left"></span>
               </h3>
               <div class="owl-carousel owl-theme mt-5">
                   @foreach($featured_categories as $cat)
                       <div class="item" th:each="tempCard : ${cards}">
                           <a href="{{route('view_category',$cat->id)}}">
                           <div class="card  my-card-style" style="height: 250px !important;">
                               <img src="{{asset($cat->image)}}" height="150px" alt="">

                               <div class="card-body">
                                   <h5 class="card-title" th:text="${tempCard.title}"> {{$cat->name}} </h5>
                                       <p class="card-text text-truncate" th:text="${tempCard.text}"> {{$cat->description}} </p>
                               </div>

                           </div>
                           </a>
                       </div>
                   @endforeach
               </div>
           </div>
       </div>
       @endif
{{-- End Category --}}


       <style>
           /* ****************** Start Products ******************* */
            .fav-title .right {
                margin-left: 20px;
                width: 100px;
                height: 4px;
                background-color: #F37021;
                display: inline-block;
                border-radius: 20px;
                max-width: 200px;
            }
           .fav-title .left {
               margin-right: 20px;
               width: 100px;
               height: 4px;
               background-color: #F37021;
               display: inline-block;
               border-radius: 20px;
               max-width: 200px;
           }
           .Products{
               padding: 100px 0;
           }
           .Products h2{
               font-size: 40px;
           }
           .Products .photo{
               position: relative;
               overflow: hidden;
               -webkit-transition: all .4s ease-in-out;
               -o-transition: all .4s ease-in-out;
               transition: all .4s ease-in-out;
               margin-bottom:40px ;
           }
           .Products .photo img{
               width: 100%;
               -webkit-transition: all .4s ease-in-out;
               -o-transition: all .4s ease-in-out;
               transition: all .4s ease-in-out;
           }
           .Products .photo:hover img {
               -webkit-transform: scale(1.2);
               -ms-transform: scale(1.2);
               transform: scale(1.2);
           }
           .Products .overlay{
               background-color: rgba(0, 195, 218, .8);
               color: #fff;
               position: absolute;
               top: 100%;
               left: 0;
               width: 100%;
               height: 100%;
               -webkit-transition: all .4s ease-in-out;
               -o-transition: all .4s ease-in-out;
               transition: all .4s ease-in-out;
               opacity: 0;
           }
           .Products .photo:hover .overlay{
               position: absolute;
               top: 0;
               left: 0;
               padding: 10px;
               opacity: 1;
           }
           .Products .overlay li {
               display: inline-block;
               margin-right: 10px;
               font-size: 15px;
           }
           .Products .overlay li a{
               color: #fff;
           }
           .Products .overlay-footer{
               position: absolute;
               top:60% ;
               left: 20px;
           }
           .Products .overlay .overlay-footer h4 {
               margin-bottom: 0;
               font-weight: bold;
               font-size: 15px;
           }
           .Products .overlay .overlay-footer span {
               font-size: 13px;
               font-weight: bold;
           }
           /* ****************** End Products ******************* */
       </style>

       <!--****************** Start Products *******************-->
       @if($featured_products->count() >= 1)
       <section class="Products text-center">
           <div class="container">
               @foreach($categories as $category)
               <div class="row">
                   <h3 class="fav-title text-center mb-5" style="color: #fff">
                       <span class="right"></span>
                         {{$category->name}}
                       <span class="left"></span>
                   </h3>
                   <div class="owl-carousel owl-theme my-3">
                       @foreach($featured_products as $Prod)
                           @if($category->id === $Prod->category_id)
                   <div class=" item mb-5" th:each="tempCard : ${cards}">
                       <a href="{{route('view_product',[$category->id , $Prod->id])}}">
                       <div class="photo">

                           <img src="{{asset($Prod->banner_image)}}"  height="150" alt="">

                                   <div class="card h-100 my-card-style">
                                       <div class="card-body">
                                           <h5 class="card-title" th:text="${tempCard.title}"> {{$Prod->name}} </h5>
                                           <p  class="card-text text-truncate" th:text="${tempCard.text}"> {{$Prod->small_description}} </p>
                                           <small class="float-start"> {{$Prod->price}} {{trans('main_trans.LE')}} </small>
                                           <small class="float-end"> <s> {{$Prod->original_price}} {{trans('main_trans.LE')}} </s> </small>
                                       </div>
                                   </div>
                       </div>
                       </a>
                   </div>
           @endif
           @endforeach
               </div>
               </div>
           @endforeach
           </div>
       </section>
       @endif
       <!--****************** End Products *******************-->

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
