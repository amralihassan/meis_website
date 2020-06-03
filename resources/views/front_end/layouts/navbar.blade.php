
<nav class="navbar navbar-expand-lg navbar-dark bg-dark ftco_navbar ftco-navbar-light" id="ftco-navbar">
    <div class="container d-flex align-items-center">
    <a class="navbar-brand" href="{{url('/home')}}">{{settingHelper()->siteNameEnglish}}</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="oi oi-menu"></span> Menu
      </button>
      <!-- <p class="button-custom order-lg-last mb-0"><a href="appointment.html" class="btn btn-secondary py-2 px-3">Make An Appointment</a></p> -->
      <div class="collapse navbar-collapse" id="ftco-nav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a href="{{url('/home')}}" class="nav-link pl-0">Home</a></li>
            <li class="nav-item"><a href="{{url('/about')}}" class="nav-link">About</a></li>
            <li class="nav-item"><a href="{{url('/admission')}}" class="nav-link">Admission</a></li>
          <li class="nav-item"><a href="{{url('/contact')}}" class="nav-link">Contact</a></li>
          <li class="nav-item"><a href="{{url('/admin')}}" class="nav-link">Login</a></li>
        </ul>
      </div>
    </div>
  </nav>
