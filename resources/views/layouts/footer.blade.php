
<style>

    /* ****************** Start Statics ******************* */
    .statics{
        padding: 50px 0;
    }
    .statics .row .col-lg i{
        color: #08526d;
        margin: 15px 0 15px 0;
    }
    .statics .row .col-lg span{
        font-size: 30px;
        font-weight: bold;
        color: #08526d;
        display: block;
    }
    .statics .row .col-lg h5{
        text-transform: uppercase;
        color: #fff3cd;
        font-weight: bold;
        font-size: 15px;
    }
    /* ****************** End Statics ******************* */


    /*************************** Strat Contact_Us ***************************/
    .Contact_Us {
        padding: 50px 0 20px ;
        color: rgb(var(--color_13));
    }

    .Contact_Us .hr1,
    .Contact_Us .hr2,
    .Contact_Us .hr3 {
        height: 1px;
        margin: auto;
        background-color: #ff305b;
        border: none;
        margin-bottom: 5px;
    }

    .hr1 {
        width: 100px;
    }

    .hr2 {
        width: 200px;
    }

    .hr3 {
        width: 100px;
    }
    .Contact_Us .Contact {
        padding: 0 0;
        text-align: center;
    }

    .Contact_Us .put{
        /*width: 50%;*/
        padding: 50px 0;
        margin: 50px auto;
    }

    .Contact_Us .put input ,textarea{
        width: 100%;
        height: 50px;
        margin-bottom: 40px;
        border-radius: 20px;
    }

    .Contact_Us .put button{
        border: none;
        border-radius: 5px;
    }

    /*************************** Strat Contact_Us ***************************/

    /*************************** Strat Footer ***************************/

    footer{
        background-color: #fff;
        padding: 30px 0;
        text-align: center;
        margin: auto;
    }

    footer .copy_footer ul li{
        display: inline-block;
        padding-left: 15px;
    }

    footer .copy_footer li a:hover{
        color: #ff305b;
        -webkit-transition: all .3s ease-in-out;
        -o-transition: all .3s ease-in-out;
        transition: all .3s ease-in-out;
    }

    footer .copy_footer p{
        color: #fff;
    }

    footer  p a{
        color: #ff305b;
    }

    footer  p a:hover{
        text-decoration: underline;
    }

    /*************************** End Footer ***************************/
</style>

<!--****************** Start Statics *******************-->
<hr>
<section class="statics text-center">
    <div class="container">
        <div class="row">

            <div class="col-lg col-6 ">
                <i class="fas fa-users fa-3x"></i>
                <span class="number"> {{count(\App\Models\User::all()->where('role',0))}} </span>
                <h5> {{trans('footer.All_clients')}} </h5>
            </div>

{{--            <div class="col-lg col-6">--}}
{{--                <i class="fa-solid fa-basket-shopping fa-3x"></i>--}}
{{--                <span class="number">{{App\Models\Category::where('status',0)->count()}}</span>--}}
{{--                <h5> {{trans('footer.Available_Categories')}} </h5>--}}
{{--            </div>--}}

{{--            <div class="col-lg col-6">--}}
{{--                <i class="fas fa-cart-plus fa-3x"></i>--}}
{{--                <span class="number">{{App\Models\Product::where('quantity' ,'>=', '1')->where('status',0)->count()}}</span>--}}
{{--                <h5> {{trans('footer.Available_Products')}} </h5>--}}
{{--            </div>--}}
            <div class="col-lg col-6">
                <i class="fas fa-cart-plus fa-3x"></i>
                <span class="number">{{App\Models\Product::where('status',1)->count()}}</span>
                <h5> {{trans('footer.Available_Products')}} </h5>
            </div>

        </div>
    </div>
</section>
<hr>
<!--****************** End Statics *******************-->

<!--************************** Start Contact_Us ***************************-->
<section class="Contact_Us">
    <div class="container">
        <div class="Contact">
            <h2 class="h1"> {{trans('main_trans.contact')}} </h2>
            <hr class="hr1">
            <hr class="hr2">
            <hr class="hr3">
        </div>
        <div class="put">

        <form id="comp-jxadgp7t" class="yBJuM"
              action="{{route('submitContact')}}" method="post">
            @csrf
            <div class="row my-2">
        <div class="col-md-6 col-12">
                <input  required type="text" placeholder="{{trans('footer.UserName')}}" name="name" value="{{Auth::user()->firstname .' '. Auth::user()->lastname}}" class="form-control">
        </div>
            <div class="col-md-6 col-12">
                <input required type="text" placeholder="{{trans('footer.PhoneNumber')}}" name="phone" value="{{auth()->user()->phone}}" class="form-control">
            </div>
            </div>
            <div class="row">
        <div class="col-12">
                <input  required type="email" placeholder="{{trans('footer.Email')}}" name="email" value="{{auth()->user()->email}}" class="form-control">
        </div>
            </div>
            <div class="row my-2">
    <div class="col-12">
        <textarea required placeholder="{{trans('footer.Message')}}" name="message" class="form-control"></textarea>
    </div>
        </div>
        <button class="form-control text-center bg-info" type="submit">{{trans('main_trans.send')}}</button>
        </form>

        </div>
    </div>
</section>
<!--************************** End Contact_Us ***************************-->

<!--************************** Start Footer ***************************-->
<footer>
    <div class="container">
        <div class="copy_footer">
            <ul class="py-2">
                <li>
                    <a href="https://www.facebook.com/2BEgypt" target="_blank"> <i class="fab fa-facebook fa-2x"></i> </a>
                </li>
                <li>
                    <a href="https://www.instagram.com/2begypt/" target="_blank"> <i class="fab fa-instagram fa-2x"></i> </a>
                </li>
                <li>
                    <a href="https://2b.com.eg/en/" target="_blank"> <i class="fab fa-google fa-2x"></i> </a>
            </ul>
        </div>
{{--        <p> Copy Right 2022 © By <a href="#"> Ahmed Ads </a> All Rights Reserved </p>--}}
        <p> {{trans('footer.copy_right')}} <a href="https://www.facebook.com/profile.php?id=100008262872020" target="_blank">
                {{trans('footer.copy_right_Name')}}</a> {{trans('footer.rights_reserved')}} </p>
    </div>
</footer>
<!--************************** End Footer ***************************-->


