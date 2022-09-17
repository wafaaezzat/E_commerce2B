
@extends('layouts.app')

@section('title')
    Ctaegories E-Shop
@endsection

@section('content')


    <div class="container py-5">
        <div class="row">
            <h2> Features Categories </h2>
                @foreach($featured_categories as $cat)
                    <div class="item">
                        <a href="{{route('view_category' , $cat->id)}}">
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
@endsection
