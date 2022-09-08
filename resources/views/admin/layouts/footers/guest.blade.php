<footer class="footer">
    <div class="container">
        <nav class="float-left">
        <ul>
            <li>
                <a href="https://business.facebook.com/dandyeg" target="_blank"> <i class="fab fa-facebook fa-2x"></i> </a>
            </li>
            <li>
                <a href="https://www.instagram.com/dandy_eg/" target="_blank"> <i class="fab fa-instagram fa-2x"></i> </a>
            </li>
            <li>
                <a href="http://ww.google.com" target="_blank"> <i class="fab fa-google fa-2x"></i> </a>
            </li>
        </ul>
        </nav>
{{--        <div class="copyright float-right">--}}
{{--        &copy;--}}
{{--        <script>--}}
{{--            document.write(new Date().getFullYear())--}}
{{--        </script>, made with <i class="material-icons">favorite</i> by--}}
{{--        <a href="https://www.creative-tim.com" target="_blank">Creative Tim</a> and <a href="https://www.updivision.com" target="_blank">UPDIVISION</a> for a better web.--}}
{{--        </div>--}}
{{--    </div>--}}
    <!--************************** Start Footer ***************************-->
        <div class="copyright float-right">
            <script src="{{ asset('frontend/js/bootstrap5.js') }}" defer></script>

            {{--        <p> Copy Right 2022 © By <a href="#"> Ahmed Ads </a> All Rights Reserved </p>--}}
            <p> {{trans('footer.copy_right')}} <a href="https://www.facebook.com/profile.php?id=100008262872020">
                    {{trans('footer.copy_right_Name')}}</a> {{trans('footer.rights_reserved')}} </p>
        </div>
        <!--************************** End Footer ***************************-->
    </div>
</footer>
