<footer class="ftco-footer ftco-bg-dark ftco-section">
    <div class="container">
      <div class="row mb-5">
        <div class="col-md-6 col-lg-4">
          <div class="ftco-footer-widget mb-5">
              <h2 class="ftco-heading-2">Have a Questions?</h2>
              <div class="block-23 mb-3">
                <ul>
                  <li><span class="icon icon-map-marker"></span><span class="text">{{ settingHelper()->address }}</span></li>
                  <li><a href="#"><span class="icon icon-phone"></span><span class="text">{{ settingHelper()->contact }}</span></a></li>
                  <li><a href="#"><span class="icon icon-envelope"></span><span class="text">{{ settingHelper()->email }}</span></a></li>
                </ul>
              </div>
          </div>
        </div>

        <div class="col-md-6 col-lg-4">
          <div class="ftco-footer-widget mb-5 ml-md-4">
            <h2 class="ftco-heading-2">Links</h2>
            <ul class="list-unstyled">
              <li><a href="{{url('home')}}"><span class="ion-ios-arrow-round-forward mr-2"></span>Home</a></li>
              <li><a href="{{url('about')}}"><span class="ion-ios-arrow-round-forward mr-2"></span>About</a></li>
              <li><a href="{{url('admission')}}"><span class="ion-ios-arrow-round-forward mr-2"></span>Admission</a></li>
              <li><a href="{{url('contact')}}"><span class="ion-ios-arrow-round-forward mr-2"></span>Contact</a></li>
            </ul>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="ftco-footer-widget mb-5">
              <h2 class="ftco-heading-2 mb-0">Connect With Us</h2>
              <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-3">
              <li class="ftco-animate"><a href="{{ settingHelper()->facebook }}"><span class="icon-facebook"></span></a></li>
              <li class="ftco-animate"><a href="{{ settingHelper()->youtube }}"><span class="icon-youtube"></span></a></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 text-center">

          <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made by MEIS
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
        </div>
      </div>
    </div>
  </footer>

    <!-- loader -->
    {{-- <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div> --}}
