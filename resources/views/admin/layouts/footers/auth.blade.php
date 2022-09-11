<footer class="footer">
  <div class="container-fluid">
    <nav class="float-left">
        <ul>
            <li>
                <a href="https://www.facebook.com/2BEgypt" target="_blank"> <i class="fab fa-facebook fa-2x"></i> </a>
            </li>
            <li>
                <a href="https://www.instagram.com/2begypt/" target="_blank"> <i class="fab fa-instagram fa-2x"></i> </a>
            </li>
            <li>
                <a href="https://2b.com.eg/en/" target="_blank"> <i class="fab fa-google fa-2x"></i> </a>
        </ul>
    </nav>
      <!--************************** Start Footer ***************************-->
      <div class="copyright float-right">
          <script src="{{ asset('frontend/js/bootstrap5.js') }}" defer></script>

          {{--        <p> Copy Right 2022 © By <a href="#"> Ahmed Ads </a> All Rights Reserved </p>--}}
          <p> {{trans('footer.copy_right')}} <a href="https://www.facebook.com/profile.php?id=100008262872020" target="_blank">
                  {{trans('footer.copy_right_Name')}}</a> {{trans('footer.rights_reserved')}} </p>
      </div>
      <!--************************** End Footer ***************************-->
  </div>
</footer>
